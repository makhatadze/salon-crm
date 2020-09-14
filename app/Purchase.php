<?php

namespace App;
use App\DistributionCompany;
use App\Department;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['purchase_type', 'overhead_number', 'purchase_number', 'distributor_id', 'purchase_date', 'office_id', 'department_id', 'responsible_person_id', 'getter_person_id', 'dgg', 'array', 'deleted_at'];
    protected $table = 'purchases';
    protected $primarykey = 'id';

    public function getDistributorName($id){
        $name = DistributionCompany::whereNull('deleted_at')->find($id);
        if($name){
            return $name->{"name_".app()->getLocale()};
        }else{
            return;
        }
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
        $user = User::whereNull('deleted_at')->find($id);
        if($user){
            $name = $user->profile()->first();
            return $name->first_name." ".$name->last_name;
        }else{
            return;
        }
    }

}
