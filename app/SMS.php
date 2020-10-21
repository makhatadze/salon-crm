<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $fillable = ['number', 'text', 'user_id'];
    protected $table = 's_m_s';
}
