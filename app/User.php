<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

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
}
