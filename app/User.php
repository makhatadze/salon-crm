<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\UserJob;
use App\Office;
use App\Department;
use App\SalaryToService;
use App\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    public function salary(){
        return $this->hasOne('App\Salary', 'user_id');
    }
    public function userHasJob(){
        return $this->hasOne('App\UserHasJob', 'user_id');
    }
    public function hasService($id)
    {
        $job = UserJob::where([['user_id', $this->id],['service_id', $id]])->first();
        if($job){
            return true;
        }
        return false;
    }
    /**
     * @return string
     */
    public function getDepartmentName(){
        $hasjob = $this->userHasJob;
        if($hasjob){
            $department = Department::find($hasjob->department_id);
            if($department){
                return $department->{"name_".app()->getLocale()} ;
            }
        }
        return;
    }
    public function services($id){
        $services = UserJob::select('services.id', 'services.title_ge', 'services.title_en', 'services.title_ru')
                    ->where('user_id', $id)
                    ->join('services', 'services.id', '=', 'user_jobs.service_id')
                    ->get();
        return $services;
    }
    public function sales(){
        return $this->hasMany('App\Sale', 'seller_id');    
    }

    public function SalaryToServices(){
        return $this->hasMany('App\SalaryToService', 'user_id');
    }
    public function salaries()
    {
        return $this->hasMany('App\Salary', 'user_id');
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
    // Money
    public function getEarnedMoney(){
        
        $money = 0;
        foreach ($this->SalaryToServices as $service) {
            $money += ($service->service_price * $service->percent/100)/100;
        }
        return number_format($money, 2); 
    }
    public function getEarnedThisMoneth()
    {
        $money = 0;
        $services = $this->SalaryToServices()
        ->whereYear('created_at', Carbon::today()
        ->isoFormat('Y'))->whereMonth('created_at', Carbon::today()
        ->isoFormat('MM'))
        ->get();
        foreach($services as $service){
            $money += ($service->service_price * $service->percent/100)/100;
        }
        return number_format($money, 2); 
    }
    public function transacrions(){
        $list = SalaryToService::where('user_id', $this->id)->get();
        if($list){
            return $list;
        }
        return;
    }
    // Clients
    public function clientservices(){
        return  $this->hasMany('App\ClientService', 'user_id');
    }
    public function ClientCount(){
        $clients = $this->clientservices()
        ->where([['user_id', $this->id], ['status', true]])
        ->count();
        return $clients;
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
        'interval_between_meeting' => 'integer',
        'brake_between_meeting' => 'integer',
    ];

}
