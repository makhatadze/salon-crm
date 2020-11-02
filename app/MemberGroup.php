<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberGroup extends Model
{
    protected $fillable = ['name'];
    public function clients()
    {
        return $this->hasMany('App\Client', 'group_id');
    }
}
