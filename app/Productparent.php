<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productparent extends Model
{
    protected $fillable  =['child_id', 'parent_id'];
    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'parent_id');
    }
}
