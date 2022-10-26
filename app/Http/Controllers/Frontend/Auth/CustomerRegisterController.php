<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerVerify;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\CustomerVerifyMail;
use App\Jobs\CustomerVerifyJob;
use App\Http\Requests\StoreCustomerRegister;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Str;
Use Alert;

class CustomerRegisterController extends Controller
{
    //Customer Register Page
    public function index(){
        return view('customer.auth.register');
    }

    public function store(StoreCustomerRegister $request){
        //Customer Validation
        $request->validated();
        //Store Customer Data in the database
        $avatarname = $request->email.Str::random(10);
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number'=>$request->phone,
            'birthday'=>$request->birthday,
            'gender'=>$request->gender,
            'photo' => $avatarname,
            'password' => Hash::make($request->password)
        ]);

        $avatar = Avatar::create($request->name)->save(storage_path('app/public/photos/'.$avatarname.'.png'));

        //Get the customer id that was inserted
        $last_id = $customer->id;
        //Genereting a unique token
        $token = $last_id.hash('sha256', \Str::random(120));
        $verifyURL = route('verify',['token'=>$token,'service'=>'Email_verification']);

        CustomerVerify::create([
            'customers_id'=>$last_id,
            'token'=>$token,
        ]);

        $message = 'Dear <b>'.$request->name.'</b>';
        $message.= ' Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

        $details = [
            'email'=>$request->email,
            'name'=>$request->name,
            'subject'=>'Go Dental Email Verification',
            'body'=> $message,
            'actionLink'=> $verifyURL,
        ];
        //dispatch the job for sending the email
        dispatch(new CustomerVerifyJob($details));
        //Redirect if successful
        if( $customer ){
            Alert::success('Registered Successfully','You can now Login. Email verification has been sent into your email account.');
            return redirect()->route('CLogin.index');
        }else{
            Alert::success('Failed To Register','Something went wrong!, Failed to register');
            return back();
        }


    }
    public function verify(Request $request){

        $token = $request->token;
        $verifyUser = CustomerVerify::where('token', $token)->first();

        if(!is_null($verifyUser)){
            $customer = $verifyUser->customers->email_verified_at;

            if(!$verifyUser->customers->email_verified_at){
                $verifyUser->customers->email_verified_at  = Carbon::now();
                $verifyUser->customers->save();

                return redirect()->route('CLogin.index')->with('info','Your email is verified successfully. You can now login')->with('verifiedEmail', $verifyUser->customers->name);
            }else{
                 return redirect()->route('CLogin.index')->with('info','Your email is already verified. You can now login')->with('verifiedEmail', $verifyUser->customers->name);
            }
        }
}
}
