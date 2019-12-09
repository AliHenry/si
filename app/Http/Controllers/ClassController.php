<?php

namespace App\Http\Controllers;

use App\AClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = AClass::all();

        return view('admin.classes.index')->with('classes', $classes);
    }

    public function show($id)
    {
        $class = AClass::findOrFail($id);

        return view('admin.classes.show')->with('class', $class);
    }

    public function create()
    {
        return view('admin.classes.store');
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ));

        $class = new AClass();
        $class->name = $request->name;
        $class->code = $request->code;

        if ($class->save()) {

            flash('Successfully created')->success();

            return redirect()->route('classes.index');
        }

        flash('Something went wrong')->error();

    }


    public function edit($id)
    {
        $class = AClass::findOrFail($id);

        return view('admin.classes.edit')->with('class',  $class);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ));

        $class = AClass::findOrFail($id);
        $class->name = $request->name;
        $class->code = $request->code;

        if ($class->save()) {

            flash('Successfully created')->success();

            return redirect()->route('classes.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $class = AClass::findOrFail($id);
        $class->delete();
        flash('Class Deleted')->success();

        return redirect()->back();
    }
}
