<?php

namespace App\Http\Controllers;

use App\Department;
use App\Designation;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::with('department')->get();

        return view('admin.designations.index')->with('designations', $designations);
    }

    public function show($id)
    {
        $designation = Designation::with('department')->where('id', $id)->first();

        return view('admin.designations.show')->with('designation', $designation);
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.designations.store')->with('departments', $departments);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
        ));


        $designation = new Designation();
        $designation->name = $request->name;
        $designation->dept_id = $request->department;

        if ($designation->save()) {

            flash('Successfully created')->success();

            return redirect()->route('designations.index');
        }

        flash('Something went wrong')->error();

    }

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        $departments = Department::all();

        return view('admin.designations.edit')->with([
            'designation' => $designation,
            'departments' => $departments
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
        ));


        $designation = Designation::findOrFail($id);
        $designation->name = $request->name;
        $designation->dept_id = $request->department;

        if ($designation->save()) {

            flash('Successfully updated')->success();

            return redirect()->route('designations.index');
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
