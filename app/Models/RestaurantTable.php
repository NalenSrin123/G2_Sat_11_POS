<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    protected $table = 'restaurant_tables';

    protected $fillable = [
        'name',
        'capacity',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'table_id');
    }
}
