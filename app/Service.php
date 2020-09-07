<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'body', 'price', 'duration', 'unit'];

    public function servicecategories(){
        return $this->morphMany('App\ServiceCategory', 'servicecategoryable');
    }
    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }
    protected $casts = [
        'price' => 'integer',
    ];
}
