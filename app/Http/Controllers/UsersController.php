<?php
namespace App\Http\Controllers;

use App\User;

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

    public function store()
    {
        $user = User::findOrFail(1);

        return view('admin.users.store')->with('user', $user);
    }

    public function create()
    {
        $user = User::findOrFail(1);

        return view('admin.users.store')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit')->with('user', $user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        flash('User Deleted')->success();

        return redirect()->back();
    }
}
