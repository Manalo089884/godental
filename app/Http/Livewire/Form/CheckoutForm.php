<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerCart;
class CheckoutForm extends Component
{
    public $action;
    public $selectedItem;

    public $customer_id;
    public $subtotal;
    public $shipping;
    public $shippingfee = 100;
    public $total;

    public $address;

    public $orders;



    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function selectItem($itemId,$action){
        $this->selectedItem = $itemId;

        if($action == 'remove'){
            $this->emit('getModelDeleteModalId',$this->selectedItem);
            $this->dispatchBrowserEvent('openRemoveModal');
        }

        $this->action = $action;
    }


    public function mount(){
        $this->customer_id = Auth::guard('customer')->user()->id;
        $this->address = CustomerShippingAddress::where('default_address',1)
        ->where('customers_id',$this->customer_id)->get();
    }


    public function render()
    {
        $this->orders = CustomerCart::with('product')->where('check',1)
        ->where('customers_id',$this->customer_id)->get();

        $this->total = 0;
        $this->subtotal = 0;

        foreach($this->orders as $checkoutorders){
            $qty = $checkoutorders->quantity;
            $sprice = $checkoutorders->product->sprice;
            $totalprice = $qty * $sprice;
            $this->subtotal += $totalprice;
            //dd($qty);
        }

        $this->total = $this->subtotal + $this->shippingfee;


        return view('livewire.form.checkout-form');
    }
}
