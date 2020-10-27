<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['category_id', 'name'];
    protected $table = "sub_categories";
    
    public function brands()
    {
        return $this->hasMany('App\Brand', 'category_id');
    }
}
