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
    protected $fillable = ['user_id','service_id', 'unchanged_service_price', 'new_price', 'duration', 'author', 'department_id', 'paid', 'session_start_time'];
    
    protected $table = 'client_services';
    
    public function clinetserviceable(){
        return $this->morphTo();
    }
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
    
    public function getEndTime(){
          return Carbon::parse($this->session_start_time)->addMinutes($this->duration)->format('H:i');
    }
    public function getAuthorName()
    {
        $user = User::find(intval($this->author));
        if($user->profile){
            return $user->profile->first_name .' '.$user->profile->last_name;
        }
        return $user->name;
    }
    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function SalaryToService()
    {
        return $this->hasMany('App\SalaryToService', 'service_id');
    }
    public function products()
    {
        return $this->hasMany('App\ProductToService', 'client_id');
    }
    public function spendonproducts()
    {
        $money = 0;
        foreach ($this->products as $key => $value) {
            $money += $value->productquntity * $value->newproductprice;
        }
        return $money;
    }
    public function productsbuyprice()
    {
        $money = 0;
        foreach ($this->products as $key => $value) {
            $money += $value->product->buy_price*$value->productquntity;
        }
        return $money;
    }
    // produqtebis mogeba an wageba
    public function getspendonproducts()
    {
        $money = 0;
        foreach ($this->products as $key => $value) {
            $money += ($value->newproductprice - $value->product->buy_price)*$value->productquntity;
        }
        return $money;
    }
}
