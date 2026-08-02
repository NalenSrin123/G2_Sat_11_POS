<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $fillable = [
        'order_id',
        'changed_by',
        'old_status',
        'new_status',
        'changed_at',
        'customer_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
