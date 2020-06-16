<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->id();
        $employee = Employee::where('user_id', $user_id)->first();

        return view('admin.profile.show')->with('employee', $employee);
    }


    public function changePassword()
    {
        $user_id = auth()->id();
        $password = Input::get('password');

        $user = User::find($user_id);
        $user->password = bcrypt($password);
        $user->save();

        return response()->json($user);

    }

}
