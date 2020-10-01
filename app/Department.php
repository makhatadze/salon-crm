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
    public function products(){
        return $this->hasMany('App\Product', 'department_id');
    }
    public function services(){
        return $this->hasMany('App\ClientService', 'department_id');
    }
}
