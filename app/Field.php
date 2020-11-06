<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Field extends Model
{
    protected $fillable = ['name', 'description'];
    public function fieldable()
    {
        return $this->morphTo();
    }
}
