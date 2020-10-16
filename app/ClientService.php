<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class ClientService extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = ['user_id','service_id', 'new_price', 'duration', 'author', 'department_id', 'paid', 'session_start_time'];
    
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
    public function getServicecurrency(){
        $price = Service::find($this->service_id);
        if($price){
            return $price->currency_type;
        }
        return;
    }
    
    public function getEndTime(){
        $duration = Service::find($this->service_id);
        if($duration){
          return Carbon::parse($this->session_start_time)->addminutes($duration->duration_count)->isoFormat('HH:MM');
        }
        return;
    }

    /**
     * Get the user.
     */
    public function getUser()
    {
        $user = User::find($this->user_id);
        return $user ? $user : false;
    }
}
