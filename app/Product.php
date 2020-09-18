<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Department;
class Product extends Model
{
    protected $fillable = ['title_ge', 'title_ru', 'title_en', 'description_ge', 'description_ru', 'description_en', 'price', 'type', 'stock', 'category_id', 'department_id'];
    protected $table = 'products';
    public function category(){
        return $this->morphOne('App\Category', 'categoryable');
    }
    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }
    public function getCategoryName(){
        $catname = Category::find($this->id)->{"title_".app()->getLocale()};
        if($catname){
            return $catname;
        }
        return;
    }
    public function getDepartmentName(){
        $depname = Department::find($this->id)->{"name_".app()->getLocale()};
        if($depname){
            return $depname;
        }
        return;
    }
    public function getOfficeName(){
        $officename = Department::find($this->id)->departmentable()->first()->{"name_".app()->getLocale()};
        if($officename){
            return $officename;
        }
        return;
    }
}
