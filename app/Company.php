<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Company extends Model
{
    use SoftDeletes;
    protected $fillable = ['title-ge', 'title-ru', 'title-en', 'description_ge', 'description_ru', 'description_en'];
    protected $table = 'companies';
    public function offices(){
        return $this->morphMany('App\Office', 'officeable');
    }
}
