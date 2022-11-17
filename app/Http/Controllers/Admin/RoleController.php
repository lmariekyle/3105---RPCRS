<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        // $roles = Role::whereNotIn('name', ['admin'])->get();
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request){
        $validated = $request->validate(['name'=>['required','min:3']]);
        Role::create($validated);

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role){

        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }

    
    public function update(Request $request,Role $role){

        $validated = $request->validate(['name'=>['required','min:3']]);
        $role->update($validated);
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role){
        $role->delete();
        return back();
        
    }

    public function show(Role $role){

        $roles= Role::all();
        $employees = User::role($role->name)->get();
        
        // if($role->name == 'Admin'){
        //     $employees = User::role('Admin')->get();
        //     }elseif($role->name == 'Employee'){
        //             $employees = User::role('Employee')->get();
        //     }else{
        //             $employees = User::role('Instructor')->get();
        // }

        return view('admin.roles.show',compact('employees','roles'));
    }

    public function givePermission(Request $request,Role $role){

        if($role->hasPermissionTo($request->permission)){
            return back()->with('message','Permission Exists');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message','Permission Added');
    }

    public function revokePermission(Role $role,Permission $permission){

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permission Revoked');
        }
        return back()->with('message','Not Exists');
    }

}
