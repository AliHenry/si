<?php

namespace App\Http\Controllers;

use App\Countries;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Countries::orderBy('name', 'ASC')->get();

        return view('admin.countries.index')->with('countries', $countries);
    }

    public function show($id)
    {
        $country = Countries::findOrFail($id);

        return view('admin.countries.show')->with('country', $country);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));


        $country = new Countries();
        $country->name = $request->name;

        if ($country->save()) {

            flash('Successfully created')->success();

            return redirect()->route('countries.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        return view('admin.countries.store');
    }

    public function edit($id)
    {
        $country = Countries::findORFail($id);

        return view('admin.countries.edit')->with('country', $country);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));


        $country = Countries::findOrFail($id);
        $country->name = $request->name;

        if ($country->save()) {

            flash('Successfully created')->success();

            return redirect()->route('roles.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $country = Countries::findOrFail($id);
        $country->delete();
        flash('Country Deleted')->success();

        return redirect()->back();
    }
}
