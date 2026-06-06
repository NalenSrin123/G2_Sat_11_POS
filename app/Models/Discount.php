<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //
    protected $fillable = [
        'name',
        'type',
        'value',
        'min_order_amount',
        'status',
        'valid_form',
        'valid_until'
    ];
}
