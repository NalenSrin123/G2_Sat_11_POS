<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class restaurant_tables extends Model
{
     protected $fillable = [
        'name',
        'capacity',
        'status',
    ];
}
