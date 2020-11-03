<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPurchase extends Model
{
    protected $fillable = [
        'purchase_id',
        'user_id',
        'payment_id',
        'pay_name',
        'paid',
        'dept'
    ];
    protected $table = 'pay_purchases';
    public function pay()
    {
        return $this->belongsTo('App\PayController', 'payment_id');
    }
}
