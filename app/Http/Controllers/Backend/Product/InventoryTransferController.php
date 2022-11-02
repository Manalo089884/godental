<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InventoryTransferController extends Controller
{
    public function index(){
        abort_if(Gate::denies('inventory_transfer'),403);
        return view('admin.page.product.inventorytransfer');
    }
    public function create(){
        abort_if(Gate::denies('inventory_transfer_create'),403);
        return view('admin.page.product.inventorytransferadd');
    }
}
