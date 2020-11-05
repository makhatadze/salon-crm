<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Department;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Product extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'title_ge',
        'title_ru',
        'title_en',
        'boughtamout',
        'description_ge',
        'description_ru',
        'description_en',
        'price',
        'purchase_id',
        'type',
        'stock',
        'unit',
        'storage_id',
        'currency',
        'buy_price',
        'department_id',
        'brand_id',
        'currency_type' 
    ];
    protected $table = 'products';
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function storage(){
        return $this->belongsTo('App\Storage');
    }
    public function purchase(){
        return $this->belongsTo('App\Purchase');
    }
    public function department(){
        return $this->belongsTo('App\Department');
    }
    public function fields(){
        return $this->morphMany('App\Field', 'fieldable');
    }
    public function brand(){
        return $this->belongsTo('App\Brand');
    }
    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }
    public function getDepartmentName(){
        $depname = Department::find($this->department_id);
        if($depname){
            return $depname->{"name_".app()->getLocale()};
        }
        return;
    }
    public function getResponsiblePerson(){
        $username = User::find($this->user_id);
        if($username){
            if($username->profile){
                return $username->profile->first_name .' '. $username->profile->last_name;
            }
            return $username->name;
        }
        return;
    }
    public function getOfficeName(){
        $officename = Department::find($this->department_id)->departmentable()->first()->{"name_".app()->getLocale()};
        if($officename){
            return $officename;
        }
        return;
    }
}
