<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Client extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = ['full_name_ge', 'full_name_ru', 'full_name_en', 'address', 'number', 'session_start_time', 'user_id'];
    protected $table = 'clients';
    protected $casts = [
        'user_id' => 'integer'
    ];
    public function clientservices(){
        return $this->morphMany('App\ClientService', 'clinetserviceable');
    }
    public function getPayedMoney(){
        $services = $this->clientservices()->where('status', true)->get();
        $money = 0;
        foreach($services as $service){
            $money += $service->service->price/100;
        }
        return $money;
    }
    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }

}
