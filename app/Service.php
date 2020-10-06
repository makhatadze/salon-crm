<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Service extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = ['title_ge','title_ru','title_en', 'body_ge', 'body_en', 'body_ru', 'price', 'duration_ge', 'duration_ru', 'duration_en', 'unit-ge', 'unit-ru', 'unit-en'];
    protected $table = 'services';
    protected $primarykey = 'id';
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }
    public function clientsOnService(){
        return $this->hasMany('App\ClientService', 'service_id');
    }
    protected $casts = [
        'price' => 'integer',
    ];
    
    public function inventories(){
        return $this->morphMany('App\Inventory', 'inventoriable');
    }
}
