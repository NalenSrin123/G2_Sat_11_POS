<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $fillable=[
        'id',
        'order_id',
        'changed_id',
        'old_status',
        'new_status',
        'changed_at',
    ];
}
