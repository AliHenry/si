<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('admin.departments.index')->with('departments', $departments);
    }

    public function show($id)
    {
        $department = Department::with('designations')->where('id', $id)->first();

        return view('admin.departments.show')->with('department', $department);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));


        $department = new Department();
        $department->name = $request->name;

        if ($department->save()) {

            flash('Successfully created')->success();

            return redirect()->route('departments.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        return view('admin.departments.store');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);;

        return view('admin.departments.edit')->with('department', $department);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));


        $department = Department::findOrFail($id);
        $department->name = $request->name;

        if ($department->save()) {

            flash('Successfully updated')->success();

            return redirect()->route('departments.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        flash('Department Deleted')->success();

        return redirect()->back();
    }
}
