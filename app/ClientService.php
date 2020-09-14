<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use App\ClientService;
use Carbon\Carbon;
class ClientService extends Model
{
    protected $fillable = ['user_id','service_id','session_start_time'];
    protected $table = 'client_services';
    public function clinetserviceable(){
        return $this->morphTo();
    }
    public function getServiceName(){
        $service = Service::find($this->service_id);
        if($service){
            return $service->{"title_".app()->getLocale()};
        }
        return;
    }
    public function getWorkerName(){
        $worker = User::find($this->user_id);
        if($worker){
            return $worker->profile()->first()->first_name." ".$worker->profile()->first()->last_name;
        }
        return;
    }
    public function getServicePrice(){
        $price = Service::find($this->service_id);
        if($price){
            return $price->price/100;
        }
        return;
    }
    public function getEndTime(){
        $duration = Service::find($this->service_id);
        if($duration){
            if($duration->duration_type == "minute"){
                return Carbon::parse($this->session_start_time)->addminutes($duration->duration_count);
            }elseif($duration->duration_type == "hours"){
                return Carbon::parse($this->session_start_time)->addHours($duration->duration_count)->format('Y-m-d h:m:s');
            }elseif($duration->duration_type == "day"){
                return $price->price/100;
            }
        }
        return;
    }
}
