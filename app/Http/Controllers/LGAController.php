<?php

namespace App\Http\Controllers;

use App\LGA;
use App\State;
use Illuminate\Http\Request;

class LGAController extends Controller
{
    public function index()
    {
        $lgas = LGA::with('state')->orderBy('name', 'asc')->get();

        return view('admin.lgas.index')->with('lgas', $lgas);
    }

    public function show($id)
    {
        $lga = LGA::with('state')->where('id', $id)->first();

        return view('admin.lgas.show')->with('lga', $lga);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'state_id' => 'required|numeric|min:1',
        ));

        $lga = new LGA();
        $lga->name = $request->name;
        $lga->state_id = $request->state_id;

        if ($lga->save()) {

            flash('Successfully created')->success();

            return redirect()->route('lgas.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        $states = State::orderBy('name', 'ASC')->get();

        return view('admin.lgas.store')->with('states', $states);
    }

    public function edit($id)
    {
        $states = State::orderBy('name', 'ASC')->get();

        $lga = LGA::with('state')->where('id', $id)->first();

        return view('admin.lgas.edit')->with([
            'lga' => $lga,
            'states' => $states,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'state_id' => 'required|numeric|min:1',
        ));


        $lga = LGA::findOrFail($id);
        $lga->name = $request->name;
        $lga->state_id = $request->state_id;

        if ($lga->save()) {

            flash('Successfully created')->success();

            return redirect()->route('lgas.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $lga = LGA::findOrFail($id);
        $lga->delete();
        flash('State Deleted')->success();

        return redirect()->back();
    }
}
