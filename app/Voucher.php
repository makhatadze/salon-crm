<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'money',
        'usedmoney',
        'status',
        'cashier_id'
    ];
    public function VoucherHistory()
    {
        return $this->hasMany('App\VoucherHistory', 'voucher_id');
    }
    public function cashier()
    {
        return $this->belongsTo('App\Cashier', 'cashier_id');
    }
}
