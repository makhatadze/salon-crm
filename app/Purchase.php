<?php

namespace App;
use App\DistributionCompany;
use App\Department;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Purchase extends Model
{
    use SoftDeletes;
    protected $fillable = ['purchase_type', 'overhead_number', 'purchase_number', 'distributor_id', 'purchase_date', 'office_id', 'department_id', 'responsible_person_id', 'getter_person_id', 'dgg', 'array', 'deleted_at'];
    protected $table = 'purchases';
    protected $primarykey = 'id';
    public function products(){
        return $this->hasMany('App\Product', 'purchase_id');
    }
    public function department(){
        return $this->belongsTo('App\Department');
    }
    public function office(){
        return $this->belongsTo('App\Office');
    }
    public function distributor(){
        return $this->belongsTo('App\DistributionCompany');
    }
    public function getDepartmentName($id){
        $name = Department::whereNull('deleted_at')->find($id);
        if($name){
            return $name->{"name_".app()->getLocale()};
        }else{
            return;
        }
    }
    public function getPersonName($id){
        $user = User::find($id);
        if($user){
            $name = $user->profile()->first();
            return $name->first_name." ".$name->last_name;
        }else{
            return;
        }
    }
    public function getPrice(){
        $total = 0;
        foreach ($this->products as $key => $value) {
            $total += $value->stock * $value->price/100;
        }
       return $total;
    }

}
