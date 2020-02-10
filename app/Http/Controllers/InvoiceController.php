<?php

namespace App\Http\Controllers;

use App\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class InvoiceController extends Controller
{
    public function paymentInvoice()
    {
        $id = Input::get('id');

        $sell = Sell::with('user', 'customer', 'type', 'status' )->where('id', $id)->first();

        $sell->products;

        //return response()->json($sell);
        return view('admin.invoice.invoice')->with('sell', $sell);

    }
}
