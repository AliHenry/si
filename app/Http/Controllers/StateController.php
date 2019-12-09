<?php

namespace App\Http\Controllers;

use App\Countries;
use App\State;
use http\Env\Response;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::with('country')->orderBy('name', 'asc')->get();

        return view('admin.states.index')->with('states', $states);
    }

    public function show($id)
    {
        $state = State::with('country')->where('id', $id)->first();

        return view('admin.states.show')->with('state', $state);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'country_id' => 'required|numeric|min:1',
        ));

        $state = new State();
        $state->name = $request->name;
        $state->country_id = $request->country_id;

        if ($state->save()) {

            flash('Successfully created')->success();

            return redirect()->route('states.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        $countries = Countries::orderBy('name', 'ASC')->get();

        return view('admin.states.store')->with('countries', $countries);
    }

    public function edit($id)
    {
        $countries = Countries::orderBy('name', 'ASC')->get();

        $state = State::with('country')->where('id', $id)->first();


        return view('admin.states.edit')->with([
            'state' => $state,
            'countries' => $countries,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'country_id' => 'required|numeric|min:1',
        ));


        $state = State::findOrFail($id);
        $state->name = $request->name;
        $state->country_id = $request->country_id;

        if ($state->save()) {

            flash('Successfully created')->success();

            return redirect()->route('states.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();
        flash('State Deleted')->success();

        return redirect()->back();
    }
}
