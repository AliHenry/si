<?php

namespace App\Http\Controllers;

use App\Sell;
use Illuminate\Http\Request;

class ProductReleaseController extends Controller
{
    public function show()
    {
        $sells = Sell::with(["products" => function($q){
            $q->where('products.cate_id', '=', 4);
        }])
            ->where('trans_status_id', 1)
            ->whereHas('products', function($q) {
                $q->where('sells_products.trans_status_id', 1);
            })->get();;

        return response()->json($sells);
    }
}
