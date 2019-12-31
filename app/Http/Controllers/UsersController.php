<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index')->with('users', $users);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::with('roles')->where('id', $id)->first();

        return view('admin.users.show')->with('user', $user);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.store')->with('roles', $roles);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        flash('User Deleted')->success();

        return redirect()->back();
    }
}
