<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'cashier_id',
        'payment_method',
        'amount_paid',
        'change_amount',
        'transaction_ref',
        'status',
        'paid_at',
    ];
}
