<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['client_id', 'address'];
    protected $table = 'sales';
    public function client(){
        return $this->belongsTo('App\Client');
    }
    public function orders(){
        return $this->hasMany('App\Order', 'sale_id');
    }
    public function getTotalPrice(){
        $money = 0;
        foreach($this->orders as $order){
            $money += $order->quantity * $order->price;
        }
        return $money/100;
    }
}
