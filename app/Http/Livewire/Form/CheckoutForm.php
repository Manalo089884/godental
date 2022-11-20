<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerCart;
use App\Models\CustomerOrder;
class CheckoutForm extends Component
{
    public $updateAddress;
    public $address;
    public $action;
    public $selectedItem;

    public $customer_id;
    public $subtotal;
    public $shipping;
    public $shippingfee = 100;
    public $total;
    public $orders;

    public $modeofpayment;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'NewAddress',
    ];

    public function NewAddress($id){
        $this->updateAddress = $id;
        $this->address = CustomerShippingAddress::where('id',$id)->get();
    }

    public function selectItem($itemId,$action){
        $this->selectedItem = $itemId;

        if($action == 'remove'){
            $this->emit('getModelDeleteModalId',$this->selectedItem);
            $this->dispatchBrowserEvent('openRemoveModal');
        }elseif($action == 'editaddress'){
            $this->emit('getAddressId',$this->selectedItem);
            $this->dispatchBrowserEvent('openAddressModal');
        }
        $this->action = $action;
    }

    public function UpdatedAddress(){
        $this->address = CustomerShippingAddress::where('id',$this->updateAddress)->get();
    }

    public function StoreCustomerOrder(){
       /*
        CustomerOrder::create([
            'customers_id' => $this->customers_id,
            'mode_of_payment' => $this->modeofpayment,
            'status' => "Pending",
            'Received_by' =>
        ]);
        */
    }

    public function mount(){
        $this->customer_id = Auth::guard('customer')->user()->id;
        $this->address = CustomerShippingAddress::where('default_address',1)
        ->where('customers_id',$this->customer_id)->get();
        foreach($this->address as $pickaddress){
            $this->updateAddress = $pickaddress->id;
        }
        $this->modeofpayment = "Cash On Delivery";
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
