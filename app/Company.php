<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Company extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = ['title_ge', 'title_ru', 'title_en', 'description_ge', 'description_ru', 'description_en'];
    protected $table = 'companies';
    public function offices(){
        return $this->morphMany('App\Office', 'officeable');
    }
}
