<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Customer;
use App\Designation;
use App\LGA;
use App\PaymentType;
use App\State;
use App\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['state', 'lga'])->get();

        return view('admin.customers.index')->with('customers', $customers);
    }

    public function show($id)
    {
        $customer = Customer::with(['state', 'lga'] )->where('id', $id)->first();

        return view('admin.customers.show')->with('customer', $customer);
    }

    public function create()
    {
        $states = State::all();
        return view('admin.customers.store')->with([
            'states' => $states,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'credit_limit' => 'required|string|max:255',
            'state_id' => 'required|string|max:255',
            'lga_id' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'avatar' => 'sometimes|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));


        $customer = new Customer();
        $customer->code = getNextCustomerNumber();
        $customer->credit_limit = $request->credit_limit;
        $customer->first_name = $request->first_name;
        $customer->middle_name = $request->middle_name ? $request->middle_name : '';
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->state_id = $request->state_id;
        $customer->lga_id = $request->lga_id;
        $customer->image = uploadImage($request);


        if ($customer->save()) {

            flash('Successfully created')->success();

            return redirect()->route('customers.index');
        }

        flash('Something went wrong')->error();

    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $states = State::all();
        $lgas = LGA::all();

        return view('admin.customers.edit')->with([
            'customer' => $customer,
            'states' => $states,
            'lgas' => $lgas
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'credit_limit' => 'required|string|max:255',
            'state_id' => 'required|string|max:255',
            'lga_id' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'active' => 'sometimes|boolean',
            'avatar' => 'sometimes|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));

        $customer = Customer::findOrFail($id);;
        $customer->credit_limit = $request->credit_limit;
        $customer->first_name = $request->first_name;
        $customer->middle_name = $request->middle_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->state_id = $request->state_id;
        $customer->lga_id = $request->lga_id;
        $customer->active = $request->active ? $request->active : false;

        if ($request->has('avatar')){
            Storage::disk('public')->delete($customer->image);
            $customer->image = uploadImage($request);
        }


        if ($customer->save()) {

            flash('Successfully updated')->success();

            return redirect()->route('customers.index');
        }

        flash('Something went wrong')->error();


    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        Storage::disk('public')->delete($customer->image);
        $customer->delete();
        flash('Customer Deleted')->success();

        return redirect()->back();
    }

    public function fetch()
    {
        $value = Input::get('dept_id');
        $data = Designation::where('dept_id', $value)->get();
        return response()->json($data);

    }


    public function fetchLga()
    {
        $value = Input::get('state_id');
        $data = LGA::where('state_id', $value)->get();
        return response()->json($data);

    }
}
