<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasJob extends Model
{
    protected $fillable = ['user_id', 'company_id', 'office_id', 'department_id'];
    protected $table = 'user_has_jobs';
}
