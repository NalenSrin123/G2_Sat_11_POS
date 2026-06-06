<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guest_sessions extends Model
{
    protected $fillable = [
        'token',
        'table_id',
        'order_id',
        'can_order',
        'expires_at',
    ];
}
