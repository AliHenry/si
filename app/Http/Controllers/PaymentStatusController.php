<?php

namespace App\Http\Controllers;

use App\PaymentStatus;
use App\PaymentType;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentStatus = PaymentStatus::all();

        return view('admin.paymentStatus.index')->with('paymentStatus', $paymentStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentStatus.store');

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

        $status = new PaymentStatus();
        $status->name = $request->name;
        $status->show = $request->show && $request->show === 'on' ? true : false ;


        if ($status->save()) {

            flash('Successfully Added')->success();

            return redirect()->route('status.index');
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
        $status = PaymentStatus::where('id', $id)->where('show', true)->first();

        return view('admin.paymentStatus.show')->with('status', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = PaymentStatus::findOrFail($id);

        return view('admin.paymentStatus.edit')->with('status', $status);
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

        $status = PaymentStatus::findOrfail($id);
        $status->name = $request->name;
        $status->show = $request->show && $request->show === 'on' ? true : false ;


        if ($status->save()) {

            flash('Successfully Updated')->success();

            return redirect()->route('status.index');
        }

        flash('Something went wrong')->error();
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $status = PaymentStatus::findOrfail($id);
        $status->delete();
        flash('Payment Status Deleted')->success();

        return redirect()->back();
    }
}
