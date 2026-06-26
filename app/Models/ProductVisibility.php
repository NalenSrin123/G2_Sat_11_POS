<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVisibility extends Model
{
    protected $table = 'product_visibility';

    protected $fillable = ['product_id','role_id','is_visible'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
