<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductToService extends Model
{
    protected $fillable = [
        'client_id',
        'product_id',
        'productquntity',
        'newproductprice'
    ];
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
    public function service()
    {
        return $this->belongsTo('App\ClientServive', 'service_id');
    }
}
