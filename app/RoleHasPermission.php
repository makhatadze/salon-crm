<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    protected $table = "role_has_permissions";
    protected $primaryKey = "id";
    public function permission(){
        return $this->belongsTo('App\Permission', 'permission_id', 'id');
    }
}
