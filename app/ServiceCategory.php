<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable =['title'];
    protected $table = 'service_categories';
    protected $primarykey = 'id';

    public function servicecategoryable(){
        return $this->morphTo();
    }
}
