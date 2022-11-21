<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\CustomerOrder;
use App\Models\OrderedProduct;
class OrderTable extends Component
{
    public function render()
    {
        $listoforders = CustomerOrder::with('customers')->get();
        $orders = [];
        $listofproducts = OrderedProduct::with('customer_orders')->get();

        foreach($listoforders as $order){

            $item = array();
            $item['order'] = $order;
            $item['products'] = [];
            $item['total'] = 0;
            foreach($listofproducts as $product){
                if($product->customer_orders_id ==  $order->id){
                    $item['total'] += $product->price * $product->quantity;
                    array_push($item['products'], $product);
                }
            }
            array_push($orders, $item);

        }
        //dd($orders);
        return view('livewire.table.order-table',[
            'listofproducts'=>  $listofproducts,
            'listoforders' => $listoforders,
            'orders' => $orders,
        ]);
    }
}
