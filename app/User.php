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
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

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
    public function isAdministrator()
    {
        return $this->hasAnyRole('administrator'); // ?? something like this! should return true or false
    }

    /**
     *
     * @return boolean
     */
    public function isAccountant()
    {
        return $this->hasAnyRole('accountant'); // ?? something like this! should return true or false
    }

    /**
     *
     * @return boolean
     */
    public function isManager()
    {
        return $this->hasAnyRole('manager'); // ?? something like this! should return true or false
    }

    /**
     *
     * @return boolean
     */
    public function isUser()
    {
        return $this->hasAnyRole('user'); // ?? something like this! should return true or false
    }
    /**
     * @return string
     */
    public function getDepartmentName(){
        $hasjob = UserHasJob::where('user_id', $this->id)->first();
        if($hasjob){
            $department = Department::find($hasjob->department_id);
            if($department->first()){
                return $department->first()->{"name_".app()->getLocale()} ;
            }
        }
        return;
    }
    public function getDepartmentId(){
        $hasjob = UserHasJob::where('user_id', $this->id)->first();
        if($hasjob){
            return $hasjob->department_id;
        }
        return;
    }
    /**
     * @return string
     */
    public function getOfficeName(){
        $office_id = UserHasJob::where('office_id', $this->id)->first();
        if($office_id){
            $office = Office::find($office_id);
            if($office){
                return $office->first()->{"name_".app()->getLocale()} ;
            }
        }
        return;
    }
    /**
     * @return string
     */
    public function getCompanyName(){
        $company_id = UserHasJob::where('company_id', $this->id)->first();
        if($company_id){
            $company = Company::find($company_id);
            if($company){
                return $company->first()->{"title_".app()->getLocale()} ;
            }
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
       $earned = SalaryToService::where('user_id', $this->id)->get();
       if($earned){
           $money = 0;
           foreach($earned as $serv){
            $money += round($serv->service_price/100 * $serv->percent/100, 2);
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
