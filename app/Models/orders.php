<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $fillable=[
        'id',
        'customer_id',
        'table_id',
        'waiter_id',
        'cashier_id',
        'cooker_id',
        'discount_id',
        'discount_applied',
        'order_type',
        'status',
        'total_amount',
        'discount_amount',
        'final_amount',
        'notes',
        'created_at',
        'updated_at',
    ];
}
