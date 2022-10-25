<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class CustomerController extends Controller
{
    //Show Customer Page
    public function index(){
        abort_if(Gate::denies('customer_access'),403);
        return view('admin.page.Users.customer');
    }
}
