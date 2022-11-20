<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;
    protected $table = 'customer_orders';
    protected $fillable = [
        'customers_id',
        'mode_of_payment',
        'status',
        'received_by',
        'phone_number',
        'notes',
        'house',
        'province',
        'city',
        'barangay'
    ];

}
