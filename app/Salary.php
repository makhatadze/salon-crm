<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['user_id', 'salary', 'bonus', 'made_salary', 'type', 'description'];
    protected $table = 'salaries';

    public function user()
    {   
        return $this->belongsTo('App\User');
    }
}
