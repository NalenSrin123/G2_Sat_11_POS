<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'order_id',
        'payment_id',
        'issued_by',
        'issued_at',
        'hjkl'
    ];
}
