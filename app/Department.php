<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name_ge', 'name_ru', 'name_en', 'address_ge', 'address_en', 'address_ru'];
    protected $table = 'departments';
    public function departmentable(){
        return $this->morphTo();
    }
}
