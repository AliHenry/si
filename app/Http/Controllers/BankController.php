<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();

        return view('admin.banks.index')->with('banks', $banks);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.banks.store');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'acc_name' => 'required|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'acc_no' => 'required|string|max:255',
            'acc_type' => 'required|string|max:255',
            'acc_officer' => 'nullable|string|max:255',
            'acc_officer_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'featured' => 'sometimes|string',
        ));


        $bank = new Bank();
        $bank->acc_name = $request->acc_name;
        $bank->bank_name = $request->bank_name;
        $bank->acc_no = $request->acc_no;
        $bank->acc_type = $request->acc_type;
        $bank->acc_officer = $request->acc_officer;
        $bank->acc_officer_number = $request->acc_officer_number;
        $bank->address = $request->address;
        $bank->featured = $request->featured && $request->featured === 'on' ? true : false ;


        if ($bank->save()) {

            flash('Successfully created')->success();

            return redirect()->route('banks.index');
        }

        flash('Something went wrong')->error();
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $bank = Bank::findOrFail($id);

        return view('admin.banks.show')->with('bank', $bank);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::findOrFail($id);

        return view('admin.banks.edit')->with('bank', $bank);
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
            'acc_name' => 'required|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'acc_no' => 'required|string|max:255',
            'acc_type' => 'required|string|max:255',
            'acc_officer' => 'nullable|string|max:255',
            'acc_officer_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'featured' => 'sometimes|string',
        ));


        $bank = Bank::findOrFail($id);
        $bank->acc_name = $request->acc_name;
        $bank->bank_name = $request->bank_name;
        $bank->acc_no = $request->acc_no;
        $bank->acc_type = $request->acc_type;
        $bank->acc_officer = $request->acc_officer;
        $bank->acc_officer_number = $request->acc_officer_number;
        $bank->address = $request->address;
        $bank->featured = $request->featured && $request->featured === 'on' ? true : false ;

        if ($bank->save()) {

            flash('Successfully Updated')->success();

            return redirect()->route('banks.index');
        }

        flash('Something went wrong')->error();
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        flash('Bank Deleted')->success();

        return redirect()->back();
    }
}
