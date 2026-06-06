<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $fillable=[
        'id',
        'product_id',
        'order_id',
        'changed_by',
        'change_aty',
        'reason',
        'created_at',

    ];
}
