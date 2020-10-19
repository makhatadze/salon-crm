<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    protected $fillable =['title_ge', 'title_en', 'title_ru', 'model_name'];
    protected $table = 'categories';
    protected $primarykey = 'id';

    public function services(){
        return $this->hasMany('App\Service', 'category_id');
    }
    public function products(){
        return $this->hasMany('App\Products', 'category_id');
    }
    public function brands(){
        return $this->hasMany('App\Brand', 'category_id');
    }
}
