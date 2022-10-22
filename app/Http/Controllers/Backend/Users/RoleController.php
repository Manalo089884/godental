<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RoleExport;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //Show Role Page
    public function index(){
        return view('admin.page.Users.role');
    }
    //Show Create Role Page
    public function create(){
        return view('admin.page.Users.rolecreate');
    }
    //Store a new role
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);

        Role::create($validated);
        return redirect()->route('role.index')->with('success', $request->name .' was successfully inserted');
    }
    //Edit Role Name
    public function edit(Role $role ){
        $permissions = Permission::all();
        return view('admin.page.Users.roleedit',compact('role','permissions'));
    }
    //Update Role Name
    public function update(Request $request, Role $role){
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);
        $role->update($validated);
        return redirect()->route('role.index')->with('success', $request->name .' was successfully edited');

    }

    public function destroy(Role $role){
        $role->delete();
        return redirect()->route('role.index')->with('success','role was successfully deleted');
    }

    public function givePermission(Request $request, Role $role){
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added');
    }

    public function revokePermission(Role $role, Permission $permission,Request $request){
        if($role->hasPermissionTo($request->permission)){
            $role->revokePermissionTo($request->permission);
            return back()->with('message', 'Permission revoked');
        }
        return back()->with('message', 'Permission not exists');
    }

    //Export Brand to Excel
    public function exportroleexcel(){
        return Excel::download(new RoleExport,'roles.xlsx');
    }
    //Export Brand to CSV
    public function exportrolecsv(){
        return Excel::download(new RoleExport,'roles.csv');
    }
    //Export Brand to HTML
    public function exportrolehtml(){
        return Excel::download(new RoleExport,'roles.html');
    }
    //Export Brand to PDF
    public function exportrolepdf(){
        return Excel::download(new RoleExport,'roles.pdf');
    }
}
