<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'image_url',
        'is_active',
        'created_by',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
