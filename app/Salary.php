<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['user_id', 'salary', 'bonus', 'cashier_id', 'made_salary', 'type', 'description', 'avansi_complate'];
    protected $table = 'salaries';

    public function user()
    {   
        return $this->belongsTo('App\User');
    }
    public function cashier(){
        return $this->belongsTo('App\Cashier', 'cashier_id');
    }
}
