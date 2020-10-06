<?php

namespace App\Http\Controllers;

use App\Role;
use Spatie\Permission\Models\Role as newRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('theme.template.role.index', compact('roles'));
    }
    public function store(Request $request){
        $this->validate($request, [
            'rolename' => 'required|string|min:3|max:13'
        ]);
        $enum = [
            'see_users',
            'add_user',
            'delete_user',
        
            'see_service',
            'add_service',
            'delete_service',
        
            'see_purchases',
            'add_purchase',
            'delete_purchase',
        
            'see_products',
            'add_product',
            'delete_product',
        
            'see_clients',
            'add_client',
            'delete_client',
        
            'export_finances',
        
            'see_company',
            'add_company',
            'delete_company',
        
            'see_sms',
            'send_sms',
            'delete_sms',
        ];
        $role = newRole::create(['name' => $request->input('rolename')]);
        foreach($request->all() as $key => $req){
            if(in_array($key, $enum)){
                $role->givePermissionTo($key);
            }
        }
        return redirect()->back();
    }
    public function edit(Role $role){
        $roles = Role::all();
        return view('theme.template.role.index', compact('roles', 'role'));
    }
    public function update(Request $request, newRole $role)
    {
        $this->validate($request, [
            'rolename' => 'required|string|min:3|max:13'
        ]);
        $enum = [
            'see_users',
            'add_user',
            'delete_user',
        
            'see_service',
            'add_service',
            'delete_service',
        
            'see_purchases',
            'add_purchase',
            'delete_purchase',
        
            'see_products',
            'add_product',
            'delete_product',
        
            'see_clients',
            'add_client',
            'delete_client',
        
            'export_finances',
        
            'see_company',
            'add_company',
            'delete_company',
        
            'see_sms',
            'send_sms',
            'delete_sms',
        ];
        if(!in_array($role, ['admin', 'user'])){
            foreach($request->all() as $key => $req){
                if(in_array($key, $enum)){
                    $role->givePermissionTo($key);
                }
            }
            $role->name = $request->input('rolename');
            $role->save();
        }
        return redirect('/roles');
    }
    public function destroy(Role $role){
        $role->delete();
        return redirect()->back();
    }
}
