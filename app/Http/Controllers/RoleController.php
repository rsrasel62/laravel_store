<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    function role(){
        $users = User::all();
        $roles = Role::all();
        $Permission = Permission::all();
        return view('admin.Role.role',[
            'permissions'=>$Permission,
            'roles'=>$roles,
            'users'=>$users,
        ]);
    }
    function permission_store(Request $request){
        Permission::create([
            'name' => $request->permission_name,
        ]);
        return back();
    }
    function role_store(Request $request){
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);
        return back();
    }
    function assign_role(Request $request){
        $request->validate([
            'user_id'=>'required',
            'role_id'=>'required',
        ]);
        $users = User::find($request->user_id);
        $users->assignRole($request->role_id);
        return back();
    }
    function remove_role($user_id){
        $user = User::find($user_id);
        $user->syncRoles([]);
        $user->syncPermissions([]);
        return back();
    }
    function eidt_user_permission($user_id){
        $user = User::find($user_id);
        $permissions = Permission::all();
        return view('admin.role.user_permission_edit',[
            'user'=>$user,
            'permissions'=>$permissions,
        ]);
    }
    function update_permission(Request $request){
        $user = User::find($request->user_id);
        $permission = $request->permission;
        $user->syncPermissions($permission);
        return back();
    }

}
