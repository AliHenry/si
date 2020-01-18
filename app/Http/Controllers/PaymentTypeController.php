<?php

namespace App\Http\Controllers;

use App\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentTypes = PaymentType::all();

        return view('admin.paymentTypes.index')->with('paymentTypes', $paymentTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentTypes.store');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'show' => 'sometimes|string',
        ));

        $type = new PaymentType();
        $type->name = $request->name;
        $type->show = $request->show && $request->show === 'on' ? true : false ;


        if ($type->save()) {

            flash('Successfully Added')->success();

            return redirect()->route('types.index');
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
        $paymentType = PaymentType::where('id', $id)->where('show', true)->first();

        return view('admin.paymentTypes.show')->with('paymentType', $paymentType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = PaymentType::findOrFail($id);

        return view('admin.paymentTypes.edit')->with('type', $type);

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
            'show' => 'sometimes|string',
        ));

        $type = PaymentType::findOrfail($id);
        $type->name = $request->name;
        $type->show = $request->show && $request->show === 'on' ? true : false ;


        if ($type->save()) {

            flash('Successfully Updated')->success();

            return redirect()->route('types.index');
        }

        flash('Something went wrong')->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = PaymentType::findOrfail($id);
        $type->delete();
        flash('Payment Type Deleted')->success();

        return redirect()->back();
    }
}
