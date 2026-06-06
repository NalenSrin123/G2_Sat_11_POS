<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVisibility extends Model
{
    //
    protected $fillable = [
        'product_id',
        'status'
    ];
}
