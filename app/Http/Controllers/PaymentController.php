<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Countries;
use App\Customer;
use App\State;
use App\Zone;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{
    public function index()
    {
        $billing = Billing::all();

        return view('admin.payment.store')->with('billing', $billing);
    }

    public function getPayment(){
        $code = Input::get('code');

        $customer = Customer::where('code', $code)->first();

        $bill = Billing::with('customer')->orderBy('created_at', 'desc')->where('cus_id', $customer->id)->first();

        return response()->json($bill);

    }

    public function makePayment(Request $request){
        $code = $request->code;
        $paid_amount = $request->paid_amount;

        $customer = Customer::with('paymentType')->where('code', $code)->first();

        $bill = Billing::with('customer')->orderBy('created_at', 'desc')->where('cus_id', $customer->id)->first();

        $oldArrears = $bill->arrears;

        $billing = new Billing();
        $billing->code = getNextBillingNumber();
        $billing->user_id = \Auth::id();
        $billing->cus_id = $customer->id;
        $billing->arrears = ($bill->arrears + $customer->paymentType->price) - $paid_amount;
        $billing->current_amount = $customer->paymentType->price;
        $billing->paid_amount = $paid_amount;
        $billing->payment_date = Carbon::parse(now()->addMonth()->day(10))->format('Y-m-d');

        if ($billing->save()){

            $bill = Billing::with('customer')->where('id', $billing->id)->first();

            $bill->oldArrears = $oldArrears;

            flash('Payment was successful')->success();

            return response()->json($bill);
        }

        flash('Something went wrong')->error();
    }

    public function show($id)
    {
        $bill = Billing::findOrFail($id);

        return view('admin.billing.show')->with('bill', $bill);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));

        $zone = new Zone();
        $zone->name = $request->name;
        $zone->code = "ZON/BAT/01/1234";

        if ($zone->save()) {

            flash('Successfully created')->success();

            return redirect()->route('zones.index');
        }

        flash('Something went wrong')->error();

    }

    public function create()
    {
        return view('admin.zones.store');
    }

    public function edit($id)
    {
        $zone = Zone::findOrFail($id);

        return view('admin.zones.edit')->with('zone', $zone);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
        ));


        $zone = Zone::findOrFail($id);
        $zone->name = $request->name;

        if ($zone->save()) {

            flash('Successfully created')->success();

            return redirect()->route('zones.index');
        }

        flash('Something went wrong')->error();

    }

    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
        flash('Zone Deleted')->success();

        return redirect()->back();
    }
}
