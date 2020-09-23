<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Office extends Model
{
    use SoftDeletes;
    protected $fillable = ['name_ge', 'name_en', 'name_ru', 'address_ge', 'address_en', 'address_ru'];
    protected $table = 'offices';
    public function officeable(){
        return $this->morphTo();
    }
    
    public function departments(){
        return $this->morphMany('App\Department', 'departmentable');
    }
}
