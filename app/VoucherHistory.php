<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherHistory extends Model
{
    protected $fillable = [
        'voucher_id',
        'description',
        'paid'
    ];
}
