<?php

namespace App\Http\Controllers;

use App\Countries;
use App\State;
use App\Zone;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::all();

        return view('admin.zones.index')->with('zones', $zones);
    }

    public function show($id)
    {
        $zone = Zone::findOrFail($id);

        return view('admin.zones.show')->with('zone', $zone);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));

        $zone = new Zone();
        $zone->name = $request->name;
        $zone->code = "ZON/BAT/01/1234";

        if ($zone->save()) {

            flash('Successfully created')->success();

            return redirect()->route('zones.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        return view('admin.zones.store');
    }

    public function edit($id)
    {
        $zone = Zone::findOrFail($id);

        return view('admin.zones.edit')->with('zone', $zone);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));


        $zone = Zone::findOrFail($id);
        $zone->name = $request->name;

        if ($zone->save()) {

            flash('Successfully created')->success();

            return redirect()->route('zones.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
        flash('Zone Deleted')->success();

        return redirect()->back();
    }

    public function getZones()
    {
        $zones = Zone::all();
        return response()->json($zones);
    }

    public function getZones2()
    {
        $zones = Input::get('zone');
        return response()->json($zones);
    }
}
