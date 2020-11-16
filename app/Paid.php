<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    protected $fillable = ['cashier_id', 'description', 'amout'];
    protected $table = "paids";
}
