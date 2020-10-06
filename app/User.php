<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\UserHasJob;
use App\Office;
use App\Department;
use App\SalaryToService;
use App\Company;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements Auditable
{
    use Notifiable, HasRoles, SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->hasAnyRole('admin');
    }
    public function isUser()
    {
        return $this->hasAnyRole('user');
    }
    
    /**
     * @return string
     */
    public function getDepartmentName(){
        $hasjob = $this->userHasJob;
        if($hasjob){
            $department = Department::find($hasjob->department_id);
            if($department->first()){
                return $department->first()->{"name_".app()->getLocale()} ;
            }
        }
        return;
    }
    public function sales(){
        return $this->hasMany('App\Sale', 'seller_id');    
    }

    public function SalaryToServices(){
        return $this->hasMany('App\SalaryToService', 'user_id');
    }
    public function getDepartmentId(){
        $hasjob = $this->userHasJob;
        if($hasjob){
            return $hasjob->department_id;
        }
        return;
    }
    /**
     * Get the user's profile.
     */
    public function profile()
    {
        return $this->morphOne('App\Profile', 'profileable');
    }

    /**
     * Get the user's image.
     */
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
    public function getEarnedMoney(){
        
        $money = 0;
        if($this->SalaryToServices->count() > 0){
            foreach ($this->SalaryToServices as $service) {
                $money += $service->service_price/100 * $service->percent/100;
            }
            return $money; 
        }
       return;
    }
    public function transacrions(){
        $list = SalaryToService::where('user_id', $this->id)->get();
        if($list){
            return $list;
        }
        return;
    }
    public function ClientCount(){
        $clients = ClientService::where([['user_id', $this->id], ['status', true]])->count();
        return $clients;
    }

}
