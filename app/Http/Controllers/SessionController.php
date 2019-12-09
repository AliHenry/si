<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Session;
use App\State;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::orderBy('start_date', 'desc')->get();

        return view('admin.sections.index')->with('sessions', $sessions);
    }

    public function show($id)
    {
        $session = Session::findOrFail($id);

        return view('admin.sections.show')->with('session', $session);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ));

        $session = new Session();
        $session->name = $request->name;
        $session->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $session->end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        if ($session->save()) {

            flash('Successfully created')->success();

            return redirect()->route('sessions.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        return view('admin.sections.store');
    }

    public function edit($id)
    {
        $session = Session::findOrFail($id);

        return view('admin.sections.edit')->with('session', $session);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ));



        $session = Session::findOrFail($id);
        $session->name = $request->name;
        $session->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $session->end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        if ($session->save()) {

            flash('Successfully created')->success();

            return redirect()->route('sessions.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();
        flash('Session Deleted')->success();

        return redirect()->back();
    }
}
