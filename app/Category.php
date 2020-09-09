<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['title_ge', 'title_en', 'title_ru'];
    protected $table = 'categories';
    protected $primarykey = 'id';

    public function categoryable(){
        return $this->morphTo();
    }
}
