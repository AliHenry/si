<?php

namespace App\Http\Controllers;

use App\ExpenditureType;
use App\PaymentType;
use Illuminate\Http\Request;

class TypeExpenditureController extends Controller
{
    public function index()
    {
        $expenTypes = ExpenditureType::all();

        return view('admin.expenditureTypes.index')->with([
            'expenditureTypes' => $expenTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expenditureTypes.store');
    }


    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ));

        $type = new ExpenditureType();
        $type->name = $request->name;
        $type->description = $request->description;


        if ($type->save()) {

            flash('Successfully Added')->success();

            return redirect()->route('expenditure-types.index');
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
        $expenditureType = ExpenditureType::findOrFail($id);

        return view('admin.expenditureTypes.show')->with('expenditureType', $expenditureType);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expentype = ExpenditureType::findOrFail($id);

        return view('admin.expenditureTypes.edit')->with('expenditureType', $expentype);
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ));

        $expenditureType = ExpenditureType::findOrFail($id);
        $expenditureType->name = $request->name;
        $expenditureType->description = $request->description;


        if ($expenditureType->save()) {

            flash('Successfully updated')->success();

            return redirect()->route('expenditure-types.index');
        }

        flash('Something went wrong')->error();
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $expenType = ExpenditureType::findOrFail($id);
        $expenType->delete();
        flash('Expenditure Type Deleted')->success();

        return redirect()->back();
    }
}
