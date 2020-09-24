<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserHasJob extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'company_id', 'office_id', 'department_id'];
    protected $table = 'user_has_jobs';

    protected $primaryKey = "user_id";
    
    
    public function user(){
        return $this->belongsTo('App/User');
    }
}
