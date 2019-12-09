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
        $customers = Customer::with(['zone','state', 'lga', 'paymentType'])->get();

        return view('admin.customers.index')->with('customers', $customers);
    }

    public function show($id)
    {
        $customer = Customer::with(['zone','state', 'lga', 'paymentType'] )->where('id', $id)->first();

        return view('admin.customers.show')->with('customer', $customer);
    }

    public function create()
    {
        $zones = Zone::all();
        $states = State::all();
        $paymentTypes = PaymentType::all();
        return view('admin.customers.store')->with([
            'states' => $states,
            'paymentTypes' => $paymentTypes,
            'zones' => $zones
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
            'zone_id' => 'required|string|max:255',
            'pay_type_id' => 'required|string|max:255',
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
        $customer->zone_id = $request->zone_id;
        $customer->pay_type_id = $request->pay_type_id;
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
            $customer = Customer::with('paymentType')->where('id', $customer->id)->first();

            $billing = new Billing();
            $billing->code = getNextBillingNumber();
            $billing->user_id = \Auth::id();
            $billing->cus_id = $customer->id;
            $billing->arrears = 0;
            $billing->current_amount = $customer->paymentType->price;
            $billing->payment_date = Carbon::parse(now()->addMonth()->day(10))->format('Y-m-d');
            $billing->save();

            flash('Successfully created')->success();

            return redirect()->route('customers.index');
        }

        flash('Something went wrong')->error();

    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $zones = Zone::all();
        $states = State::all();
        $paymentTypes = PaymentType::all();
        $lgas = LGA::all();

        return view('admin.customers.edit')->with([
            'customer' => $customer,
            'zones' => $zones,
            'states' => $states,
            'paymentTypes' => $paymentTypes,
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
            'zone_id' => 'required|string|max:255',
            'pay_type_id' => 'required|string|max:255',
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
        $customer->zone_id = $request->zone_id;
        $customer->pay_type_id = $request->pay_type_id;
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
