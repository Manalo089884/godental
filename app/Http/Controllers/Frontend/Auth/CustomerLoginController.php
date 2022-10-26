<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\StoreLoginRequest;
use Illuminate\Support\Facades\Auth;
Use Alert;
class CustomerLoginController extends Controller
{
    //Login Customer Controller
    public function index(){
        return view('customer.auth.login');
    }
    //Login Function
    public function store(StoreLoginRequest $request){
        $request->validated();
        $creds = $request->only('email','password');
        if(Auth::guard('customer')->attempt($request->only('email','password'),$request->remember)){
            Alert::success('Login Successfully ','Welcome to Go Dental' );
            return redirect()->route('home');
        }else{
            return back()->with('fail', 'Your Account and/or password is incorrect, please try again');
        }
    }
}
