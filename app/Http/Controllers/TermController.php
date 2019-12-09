<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Session;
use App\State;
use App\Term;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index()
    {
        $terms = Term::with('session')->get();

        return view('admin.terms.index')->with('terms', $terms);
    }

    public function show($id)
    {
        $term = Term::with('session')->where('id', $id)->first();

        return view('admin.terms.show')->with('term', $term);
    }

    public function create()
    {
        $sessions = Session::all();

        return view('admin.terms.store')->with('sessions', $sessions);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'session_id' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ));

        $term = new Term();
        $term->name = $request->name;
        $term->session_id = $request->session_id;
        $term->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $term->end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        if ($term->save()) {

            flash('Successfully created')->success();

            return redirect()->route('terms.index');
        }

        flash('Something went wrong')->error();

    }


    public function edit($id)
    {
        $sessions = Session::all();
        $term = Term::with('session')->where('id', $id)->first();

        return view('admin.terms.edit')->with([
            'term' => $term,
            'sessions' => $sessions
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'session_id' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ));

        $term = Term::findOrFail($id);
        $term->name = $request->name;
        $term->session_id = $request->session_id;
        $term->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $term->end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        if ($term->save()) {

            flash('Successfully created')->success();

            return redirect()->route('terms.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $term = Term::findOrFail($id);
        $term->delete();
        flash('Term Deleted')->success();

        return redirect()->back();
    }
}
