<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','name','price','image_url','is_active','created_by'];

    public function category(){
        return $this->belongsTo(categories::class);
    }
}
