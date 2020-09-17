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
    public function department(){
        return $this->morphOne('App\Department', 'departmentable');
    }
    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }
    public function getCategoryName($id){
        $catname = Category::find($id)->{"title_".app()->getLocale()};
        return $catname;
    }
    public function getDepartmentName($id){
        $depname = Department::find($id)->{"name_".app()->getLocale()};
        return $depname;
    }
}
