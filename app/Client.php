<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['full_name_ge', 'full_name_ru', 'full_name_en', 'address', 'number', 'session_start_time', 'user_id'];
    protected $table = 'clients';
    protected $casts = [
        'user_id' => 'integer'
    ];
    public function clientservices(){
        return $this->morphMany('App\ClientService', 'clinetserviceable');
    }
}
