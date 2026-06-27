<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = [
        'name',
        'image_url',
        'is_active',
        'created_by',
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
