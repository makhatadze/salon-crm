<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'money',
        'usedmoney',
        'status'
    ];
    public function VoucherHistory()
    {
        return $this->hasMany('App\VoucherHistory', 'voucher_id');
    }
}
