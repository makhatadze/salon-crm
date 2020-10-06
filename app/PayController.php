<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayController extends Model
{
    protected $fillable = ['name_ge', 'name_ru', 'name_en'];
}
