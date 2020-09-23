<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Client extends Model
{
    use SoftDeletes;
    protected $fillable = ['full_name_ge', 'full_name_ru', 'full_name_en', 'address', 'number', 'session_start_time', 'user_id'];
    protected $table = 'clients';
    protected $casts = [
        'user_id' => 'integer'
    ];
    public function clientservices(){
        return $this->morphMany('App\ClientService', 'clinetserviceable');
    }
    public function getPayedMoney(){
        $services = $this->clientservices()->where('status', true)->wherenull('deleted_at')->get();
        $money = 0;
        foreach($services as $service){
            $money += $service->getServicePrice();
        }
        return $money;
    }
}
