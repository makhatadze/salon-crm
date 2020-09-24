<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Department extends Model
{
    use SoftDeletes;
    protected $fillable = ['name_ge', 'name_ru', 'name_en', 'address_ge', 'address_en', 'address_ru'];
    protected $table = 'departments';
    public function departmentable(){
        return $this->morphTo();
    }
    public function purchases(){
        return $this->hasMany('App\Purchase', 'department_id');
    }
}
