<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['name'];
    protected $table = "roles";
    protected $primaryKey = "id";
    public function permissions(){
        return $this->hasMany('App\RoleHasPermission', 'role_id');
    }
    public function checkPermission($name){
        $permission_id = Permission::where('name', 'like', $name)->first();
        if($permission_id && $this->permissions->where('permission_id', $permission_id->id)->first() ){
            return true;
        }
        return false;
    }
}
