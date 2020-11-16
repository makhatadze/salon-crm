<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayController extends Model
{
    protected $fillable = ['name_ge', 'name_ru', 'name_en', 'cashier_id'];
    public function cashier()
    {
        return $this->belongsTo('App\Cashier', 'cashier_id');
    }
}
