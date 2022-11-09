<?php

namespace App\Http\Livewire\Table;

use App\Models\CustomerCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartTable extends Component
{
    public $items = [];
    public $subtotal = 0;
    public $val;
    public $shippingfee = 0;
    public $total = 0;

    public $action;
    public $selectedItem;

    public function ProceedToCheckout(){

    }

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function selectItem($itemId,$action){
        $this->selectItem = $itemId;

        if($action == 'remove'){
            $this->emit('getModelDeleteModalId',$this->selectItem);
            $this->dispatchBrowserEvent('openRemoveModal');
        }elseif($action == 'adjust'){
            $this->emit('getModelAdjustModalId',$this->selectItem);
            $this->dispatchBrowserEvent('openAdjustModal');
        }else{

        }
        $this->action = $action;
    }

    public function updatedItems(){
        $this->total = 0;
        $this->subtotal = 0;
         foreach($this->items as $item){
            $checkitems = CustomerCart::with('product')->where('id',$item)->get();
            foreach($checkitems as $checkitem){
                $qty = $checkitem->quantity;
                $sprice = $checkitem->product->sprice;
                $totalprice = $qty * $sprice;
                $this->val += $totalprice;
            }
       }
       $this->subtotal += $this->val;
       $this->val = 0;
       $this->shippingfee = 0;
       if($this->subtotal != 0){
            $this->shippingfee = 100;
            $this->total = $this->subtotal + $this->shippingfee;
       }

    }
    public function mount(){
        $this->validatequantity();
    }

    public function validatequantity(){
        if (Auth::guard('customer')->check()){
            $customer_id = Auth::id();
            $carts = CustomerCart::with('product','customer')->where('customers_id', $customer_id)->get();

        }else{
            return redirect()->route('CLogin.index');
        }

        foreach($carts as $cart){
            $updatecart = CustomerCart::with('product','customer')->where('product_id', $cart->product_id)->where('customers_id', $customer_id)->get();
            foreach($updatecart as $items){
                if($items->quantity > $cart->product->stock){
                    $items->quantity = $cart->product->stock;
                    $items->update();
                }
            }
        }
    }

    public function render()
    {
        if (Auth::guard('customer')->check()){
            $customer_id = Auth::id();
            $cart = CustomerCart::with('product','customer')->where('customers_id', $customer_id)->get();

        }else{
            return redirect()->route('CLogin.index');
        }
        $this->validatequantity();
        return view('livewire.table.cart-table',[
            'cart' => $cart,
        ]);
    }
}
