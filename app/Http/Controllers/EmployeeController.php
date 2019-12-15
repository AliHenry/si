<?php

namespace App\Http\Controllers;

use App\Department;
use App\Designation;
use App\Employee;
use App\LGA;
use App\State;
use App\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {

        $employees = Employee::with(['department', 'designation'])->get();


        return view('admin.employees.index')->with('employees', $employees);
    }

    public function show($id)
    {
        $employee = Employee::with(['department', 'designation', 'user'] )->where('id', $id)->first();

        return view('admin.employees.show')->with('employee', $employee);
    }

    public function create()
    {
        $states = State::all();
        $departments = Department::all();
        $users = User::all();
        return view('admin.employees.store')->with([
            'departments' => $departments,
            'users' => $users,
            'states' => $states,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'phone' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'user_id' => 'required|string|max:255|unique:employees',
            'date_of_birth' => 'required|date',
            'join_date' => 'required|date',
            'state_id' => 'required|string|max:255',
            'lga_id' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'avatar' => 'sometimes|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));

        //return response()->json($path);


        $employee = new Employee();
        $employee->code = getNextEmployeeNumber();
        $employee->user_id = $request->user_id;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->gender = $request->gender;
        $employee->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
        $employee->join_date = Carbon::parse($request->join_date)->format('Y-m-d');
        $employee->address = $request->address;
        $employee->dept_id = $request->department;
        $employee->job_type = $request->designation;
        $employee->country_id = 1;
        $employee->state_id = $request->state_id;
        $employee->lga_id = $request->lga_id;
        $employee->image = uploadImage($request);


        if ($employee->save()) {

            flash('Successfully created')->success();

            return redirect()->route('employees.index');
        }

        flash('Something went wrong')->error();

    }

    public function edit($id)
    {
        $employee = Employee::with(['department', 'designation', 'user'] )->where('id', $id)->first();
        $designation = Designation::all();
        $departments = Department::all();
        $users = User::all();

        return view('admin.employees.edit')->with([
            'designation' => $designation,
            'departments' => $departments,
            'employee' => $employee,
            'users' => $users
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'join_date' => 'required|date',
            'state' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'avatar' => 'sometimes|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));


        $employee = Employee::findOrFail($id);;
        $employee->user_id = $request->user_id;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->gender = $request->gender;
        $employee->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
        $employee->join_date = Carbon::parse($request->join_date)->format('Y-m-d');
        $employee->address = $request->address;
        $employee->state = $request->state;
        $employee->dept_id = $request->department;
        $employee->job_type = $request->designation;

        if ($request->has('avatar')){
            Storage::disk('public')->delete($employee->image);
            $employee->image = uploadImage($request);
        }


        if ($employee->save()) {

            flash('Successfully updated')->success();

            return redirect()->route('employees.index');
        }

        flash('Something went wrong')->error();


    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        Storage::disk('public')->delete($employee->image);
        $employee->delete();
        flash('Employee Deleted')->success();

        return redirect()->back();
    }

    public function fetch()
    {
        $value = Input::get('dept_id');
        $data = Designation::where('dept_id', $value)->get();
        return response()->json($data);

    }

    public function fetchLga()
    {
        $value = Input::get('state_id');
        $data = LGA::where('state_id', $value)->get();
        return response()->json($data);

    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, array(
            'password' => 'required|string|max:255',
        ));

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);

        if ($user->save()) {

            flash('Password Changed')->success();

            return redirect()->back();
        }

        flash('Something went wrong')->error();

    }

}
