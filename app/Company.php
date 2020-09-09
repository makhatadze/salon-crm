<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['title-ge', 'title-ru', 'title-en', 'description_ge', 'description_ru', 'description_en'];
    protected $table = 'companies';
    public function offices(){
        return $this->morphMany('App\Office', 'officeable');
    }
}
