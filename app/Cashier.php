<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $fillable = ['name', 'amout'];
    public function paid()
    {
        return $this->hasMany('App\Paid', 'cashier_id');
    }
}
