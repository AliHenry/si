<?php

namespace App\Http\Controllers;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index')->with('roles', $roles);
    }

    public function show($id)
    {
        $role = Role::with('permissions')->where('id', $id)->first();

        return view('admin.roles.show')->with('role', $role);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'permissions' => 'sometimes|array',
        ));


        $role = new Role();
        $role->name = $request->name;
        $role->slug = strtolower($request->name);
        $role->description = $request->description;

        if ($role->save()) {

            $role->syncPermissions($request->permissions);

            flash('Successfully created')->success();

            return redirect()->route('roles.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.zzzz')->with('permissions', $permissions);
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->where('id', $id)->first();

        $permissions = Permission::all();

        return view('admin.roles.edit')->with([
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'permissions' => 'sometimes|array',
        ));


        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->slug = strtolower($request->name);
        $role->description = $request->description;


        return response()->json($request->all());

        if ($role->save()) {

            return response()->json($request->permissions);

//            $role->syncPermissions($request->permissions);
//
//            flash('Successfully created')->success();

            return redirect()->route('roles.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->detachAllPermissions();
        $role->delete();
        flash('Role Deleted')->success();

        return redirect()->back();
    }
}
