<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Department;
use App\Designation;
use App\Employee;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();

        foreach ($attendances as $attendance){
            $attendance->present = attendanceCount($attendance->id, 1);
            $attendance->absent = attendanceCount($attendance->id, 2);
            $attendance->sick = attendanceCount($attendance->id, 3);
            $attendance->leave = attendanceCount($attendance->id, 4);
        }


        return view('admin.attendance.index')->with('attendances', $attendances);
    }

    public function show($id)
    {
        $attendance = Attendance::with('employees')->where('id', $id)->first();
        foreach ($attendance->employees as $employee){
            $employee->attend_type = attendanceType($attendance->id, $employee->id);
        }

        return view('admin.attendance.show')->with('attendance', $attendance);
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.attendance.store')->with('employees', $employees);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'day' => 'required|date',
            'types' => 'required|array',
        ));

        $attendance = new Attendance();
        $attendance->day = Carbon::parse($request->day)->format('Y-m-d');
        $attendance->code = getNextAttendanceNumber();

        //return response()->json($attendance);

        if ($attendance->save()) {

            $attendance = Attendance::findOrFail($attendance->id);
            $keys = array_keys($request->types);
            $types = $request->types;
            //return response()->json($request->types, $keys);
            foreach ($keys as  $key){
                $attendance->employees()->attach($key, ['type' => $types[$key]]);
            }


            flash('Successfully created')->success();

            return redirect()->route('attendance.index');
        }

        flash('Something went wrong')->error();

    }

    public function edit($id)
    {
        $attendance = Attendance::with('employees')->where('id', $id)->first();

        return view('admin.attendance.edit')->with([
            'attendance' => $attendance,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'day' => 'required|date',
            'types' => 'required|array',
        ));

        $attendance = Attendance::findOrfail($id);
        $attendance->day = Carbon::parse($request->day)->format('Y-m-d');

        if ($attendance->save()) {

            $keys = array_keys($request->types);
            $types = $request->types;
            //return response()->json($request->types, $keys);
            $attendance->employees()->detach();
            foreach ($keys as  $key){
                $attendance->employees()->attach($key, ['type' => $types[$key]]);
            }


            flash('Successfully created')->success();

            return redirect()->route('attendance.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        $attendance->employees()->detach();
        flash('Department Deleted')->success();

        return redirect()->back();
    }
}
