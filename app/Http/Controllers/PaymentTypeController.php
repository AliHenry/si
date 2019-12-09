<?php

namespace App\Http\Controllers;

use App\Countries;
use App\PaymentType;
use App\State;
use App\Zone;
use http\Env\Response;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function index()
    {
        $paymentTypes = PaymentType::all();

        return view('admin.payment-type.index')->with('paymentTypes', $paymentTypes);
    }

    public function show($id)
    {
        $paymentType = PaymentType::findOrFail($id);

        return view('admin.payment-type.show')->with('paymentType', $paymentType);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ));

        $paymentType = new PaymentType();
        $paymentType->name = $request->name;
        $paymentType->price = $request->price;;

        if ($paymentType->save()) {

            flash('Successfully created')->success();

            return redirect()->route('payment-type.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        return view('admin.payment-type.store');
    }

    public function edit($id)
    {
        $paymentType = PaymentType::findOrFail($id);

        return view('admin.payment-type.edit')->with('paymentType', $paymentType);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ));


        $paymentType = PaymentType::findOrFail($id);
        $paymentType->name = $request->name;
        $paymentType->price = $request->price;

        if ($paymentType->save()) {

            flash('Successfully created')->success();

            return redirect()->route('payment-type.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->delete();
        flash('Payment Type Deleted')->success();

        return redirect()->back();
    }
}
