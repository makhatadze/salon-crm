<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = ['sale_id', 'product_id', 'quantity'];
    protected $table = 'orders';
    public function sale(){
        return $this->belongsTo('App\Sale');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
