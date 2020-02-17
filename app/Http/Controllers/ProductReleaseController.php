<?php

namespace App\Http\Controllers;

use App\Sell;
use App\StoreAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductReleaseController extends Controller
{
    private $trans_status_paid = 1;

    public function index()
    {

        $sells = Sell::with(["products" => function($q){
            $cate_id = store_managers_permission(auth()->user()->role);
            if ($cate_id){
                $q->where('products.cate_id', '=', $cate_id);
            }
        }])
            ->where('trans_status_id', $this->trans_status_paid)
            ->whereHas('products', function($q) {
                $cate_id = store_managers_permission(auth()->user()->role);
                $q->where('products.cate_id', $cate_id);
                $q->where('sells_products.trans_status_id', $this->trans_status_paid);
            })->get();

        //return response()->json($sells);
        return view('admin.releaseProducts.index')->with([
            'sells' => $sells
        ]);
    }
    public function show($id)
    {
        $sell = Sell::with(["products" => function($q){
            $cate_id = store_managers_permission(auth()->user()->role);
            if ($cate_id){
                $q->where('products.cate_id', '=', $cate_id);
            }
        }])
            ->where('id', $id)
            ->first();

        //return response()->json($sells);
        return view('admin.releaseProducts.show')->with([
            'sell' => $sell
        ]);
    }

    public function releaseProduct()
    {
        $sell_id = Input::get('sell_id');
        $prod_id = Input::get('prod_id');
        $status = Input::get('status');
        $status = $status ? 2 : 1;

        // find sell
        $sell = Sell::findOrFail($sell_id);

        // update product release status
        if ($sell->products()->updateExistingPivot($prod_id, ['trans_status_id' => $status])){

            // check if all updated
            $check = updatePaymentStatus($sell_id);
            if (!$check){
                $sell->trans_status_id = 2;
                $sell->save();
            }
        }

        return response()->json($sell);
    }
}
