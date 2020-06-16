<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Expenditure;
use App\ExpenditureType;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenditureController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $expenditures = Expenditure::with('type')->get();

        return view('admin.expenditures.index')->with([
            'expenditures' => $expenditures
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ExpenditureType::all();

        return view('admin.expenditures.store')->with('types', $types);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|string|max:255',
            'type_id' => 'required|string',
            'amount' => 'required|string',
            'description' => 'required|string|max:255',
            'paid_to' => 'required|string|max:255',
            'avatar' => 'nullable|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));

        $expenditure = new Expenditure();
        $expenditure->title = $request->title;
        $expenditure->type_id = $request->type_id;
        $expenditure->description = $request->description;
        $expenditure->amount = $request->amount;
        $expenditure->paid_to = $request->paid_to;
        $request->file('avatar') ? $expenditure->image = uploadImage($request) : null;


        if ($expenditure->save()) {

            flash('Successfully Added')->success();

            return redirect()->route('expenditures.index');
        }

        flash('Something went wrong')->error();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expenditure = Expenditure::with('type')->where('id',$id)->first();
        return view('admin.expenditures.show')->with([
            'expenditure' => $expenditure,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expenditure = Expenditure::findOrFail($id);
        $types = ExpenditureType::all();

        return view('admin.expenditures.edit')->with([
            'expenditure' => $expenditure,
            'types' => $types
        ]);

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'title' => 'required|string|max:255',
            'type_id' => 'required|string',
            'amount' => 'required|string',
            'description' => 'required|string|max:255',
            'paid_to' => 'required|string|max:255',
            'avatar' => 'nullable|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));

        $expenditure = Expenditure::findOrFail($id);
        $expenditure->title = $request->title;
        $expenditure->type_id = $request->type_id;
        $expenditure->description = $request->description;
        $expenditure->amount = $request->amount;
        $expenditure->paid_to = $request->paid_to;

        if ($request->file('avatar')){
            Storage::disk('public')->delete($expenditure->image);
            $expenditure->image = uploadImage($request);
        }

        if ($expenditure->save()) {

            flash('Successfully Updated')->success();

            return redirect()->route('expenditures.index');
        }

        flash('Something went wrong')->error();
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $expenditure = Expenditure::findOrFail($id);
        Storage::disk('public')->delete($expenditure->image);
        $expenditure->delete();
        flash('Expenditure Deleted')->success();

        return redirect()->back();
    }
}
