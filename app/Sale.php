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
        'address'
    ];
    protected $table = 'sales';
    public function client(){
        return $this->belongsTo('App\Client');
    }
    public function getSellerName(){
        $user = User::find($this->seller_id);
        if($user->profile){
        return $user->profile->first_name .' '.$user->profile->last_name;
        }else{
            return $user->name;
        }
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
