<?php
namespace App\Http\Controllers;

use App\Brand;
use App\User;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index')->with('users', $users);
    }

    public function show($id)
    {
        $user = User::with('roles')->where('id', $id)->first();

        return view('admin.users.show')->with('user', $user);
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.store')->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed|max:255',
            'role_id' => 'required|string',
        ));


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $role = Role::findOrFail($request->role_id);
        $user->role = $role->name;

        if ($user->save()) {

            $user->attachRole($role);

            flash('Successfully created')->success();

            return redirect()->route('users.index');
        }

        flash('Something went wrong')->error();
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'sometimes|min:6|confirmed|max:255',
            'role_id' => 'required|string',
        ));


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $role = Role::findOrFail($request->role_id);
        $user->role = $role->name;

        if ($user->save()) {

            $user->attachRole($role);

            flash('Successfully created')->success();

            return redirect()->route('users.index');
        }

        flash('Something went wrong')->error();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        flash('User Deleted')->success();

        return redirect()->back();
    }
}
