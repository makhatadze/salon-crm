<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title_ge', 'title_ru', 'title_en', 'description_ge', 'description_ru', 'description_en'];
    protected $table = 'products';
    public function categories(){
        return $this->morphMany('App\Category', 'categoriable');
    }
    public function images(){
        return $this->morphMany('App\Category', 'imageable');
    }
}
