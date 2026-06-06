<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KitchenQueue extends Model
{
    protected $fillable = [
        'order_id',
        'status',
        'priority',
        'assigned_to',
        'notified_waiter',
        'queued_at',
        'acked_at',
        'ready_at',
        'notified_at',
    ];
}
