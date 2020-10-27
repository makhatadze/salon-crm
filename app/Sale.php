<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Sale extends Model implements Auditable
{
    
use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'client_id',
        'service_id',
        'service_price',
        'percent',
        'sale_id',
        'address',
        'paid',
        'total',
        'pay_method',
        'pay_method_id'
    ];
    protected $table = 'sales';
    public function client(){
        return $this->belongsTo('App\Client');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'seller_id', 'id');
    }
    public function orders(){
        return $this->hasMany('App\Order', 'sale_id');
    }
    public function totalOriginalPrice()
    {
        $money = 0;
        foreach ($this->orders as $item) {
            $money += $item->product->buy_price * $item->quantity;
        }
        return $money;
    }
    public function getTotalPrice(){
        $money = 0;
        foreach($this->orders as $order){
            $money += $order->quantity * $order->price;
        }
        return number_format($money/100, 2);
    }
    protected $casts = [
        'total' => 'integer',
        'paid' => 'integer',
    ];
}
