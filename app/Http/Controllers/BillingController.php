<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Countries;
use App\Customer;
use App\State;
use App\Zone;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BillingController extends Controller
{
    public function index()
    {
        //$billing = Billing::all();
        $billing = Billing::with('user')->whereYear('payment_date', Carbon::now()->year)->whereMonth('payment_date', '>=', Carbon::now()->month)->get();

        return view('admin.billing.index')->with('billing', $billing);
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

    public function generateBill()
    {
        return view('admin.billing.generate');
    }

    public function billToPDF()
    {
        $zone = Input::get('zone');
        $customers = Customer::where('zone_id', $zone)->get('id');
        $billing = Billing::whereIn('cus_id', $customers)->whereMonth('payment_date', Carbon::now()->month)->get();

        $pdf = PDF::loadView('admin.invoice.invoice3', ['billing' => $billing])->setPaper('a4', 'landscape');

        return $pdf->download('invoice.pdf');

        return response()->json($billing);
    }
}
