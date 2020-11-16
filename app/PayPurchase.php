<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPurchase extends Model
{
    protected $fillable = [
        'purchase_id',
        'user_id',
        'cashier_id',
        'pay_name',
        'paid',
        'dept'
    ];
    protected $table = 'pay_purchases';
    public function pay()
    {
        return $this->belongsTo('App\Cashier', 'cashier_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
