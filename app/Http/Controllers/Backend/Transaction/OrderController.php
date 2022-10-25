<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class OrderController extends Controller
{
    //Show Order Transaction Page
    public function index(){
        abort_if(Gate::denies('order_access'),403);
        return view('admin.page.Transaction.order');
    }
}
