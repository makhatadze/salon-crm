<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    protected $fillable = ['product_id', 'real', 'old', 'status'];
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
