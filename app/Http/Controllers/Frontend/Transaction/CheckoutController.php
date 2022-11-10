<?php

namespace App\Http\Controllers\Frontend\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerCart;

class CheckoutController extends Controller
{
    public function index(){
        $customer_id = Auth::guard('customer')->user()->id;
        $checkoutcount = CustomerCart::with('product','customer')
            ->where('customers_id', $customer_id)
            ->where('check',1)
            ->get();

            if(count($checkoutcount) == 0){
                return redirect()->route('cart.index');
            }
        return view('customer.page.cart.checkout');
    }
    public function store(){

    }
}
