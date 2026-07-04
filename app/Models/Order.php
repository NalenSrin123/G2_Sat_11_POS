<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
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
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'table_id');
    }
}
