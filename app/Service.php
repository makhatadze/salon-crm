<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title_ge','title_ru','title_en', 'body_ge', 'body_en', 'body_ru', 'price', 'duration_ge', 'duration_ru', 'duration_en', 'unit-ge', 'unit-ru', 'unit-en'];
    protected $table = 'services';
    protected $primarykey = 'id';
    public function category(){
        return $this->morphOne('App\Category', 'categoryable');
    }
    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }
    protected $casts = [
        'price' => 'integer',
    ];
    
    public function inventories(){
        return $this->morphMany('App\Inventory', 'inventoriable');
    }
}
