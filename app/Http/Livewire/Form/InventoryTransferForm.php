<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Supplier;
class InventoryTransferForm extends Component
{
    public $origin;
    public $toggleinfo = false;
    public function render()
    {

        $suppliers = Supplier::get();
        if($this->origin != null){
            $supplierinfo = Supplier::where('id',$this->origin)->get();
            $this->toggleinfo = true;
        }else{
            $supplierinfo = [];
            $this->toggleinfo = false;
        }

        return view('livewire.form.inventory-transfer-form',[
            'suppliers'  => $suppliers,
            'supplierinfo' => $supplierinfo,
        ]);
    }
}
