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

    public function releaseInvoice()
    {
        $id = Input::get('id');

//        $sell = Sell::with('user', 'customer', 'type', 'status' )->where('id', $id)->first();
//
//        $sell->products;

//        $sell = Sell::with('user', 'customer', 'type', 'status', 'products')
//            ->where('id', $id)
//            ->whereHas('products', function($q) {
//                $cate_id = store_managers_permission(auth()->user()->role);
//                $q->where('products.cate_id', $cate_id);
//            })
//            ->first();
        $sell = Sell::with(['user', 'customer', 'type', 'status', "products" => function($q){
            $cate_id = store_managers_permission(auth()->user()->role);
            if ($cate_id){
                $q->where('products.cate_id', '=', $cate_id);
            }
        }])
            ->where('id', $id)
            ->first();

        //return response()->json($sell);
        return view('admin.invoice.release-invoice')->with(['sell' => $sell]);

    }
}
