<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('roles')->get();

        return view('admin.permissions.index')->with('permissions', $permissions);
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.show')->with('permission', $permission);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));


        if (set_permission($request->name)){
            flash('Successfully created')->success();
            return redirect()->route('permissions.index');
        }

        flash('Something went wrong')->error();


    }

    public function create()
    {
        $user = User::findOrFail(1);

        return view('admin.permissions.store')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.permissions.edit')->with('user', $user);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        flash('Permissions Deleted')->success();

        return redirect()->back();
    }
}
