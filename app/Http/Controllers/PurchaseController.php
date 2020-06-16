<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::with('user', 'product', 'supplier')->get();

        //return response()->json($truckCount);

        return view('admin.purchases.index')->with([
            'purchases' => $purchases
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('admin.purchases.store')->with([
           'products' => $products,
           'suppliers' => $suppliers
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, array(
            'supplier_name' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|string',
            'prod_id' => 'required|string',
            'supplied_qty' => 'nullable|numeric',
            'supplied_price' => 'required|string',
            'discount' => 'required|string',
            'truck_no' => 'required|string',
            'damage_prod' => 'required|numeric',
            'avatar' => 'sometimes|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]

        ));

        $product = Product::findOrFail($request->prod_id);

        $purchase = new Purchase();
        $request->supplier_name ? $purchase->supplier_name = $request->supplier_name : null;
        $request->supplier_id ? $purchase->supplier_id = $request->supplier_id : null;
        $purchase->prod_id = $request->prod_id;
        $purchase->supplied_qty = $request->supplied_qty;
        $purchase->supplied_price = $request->supplied_price;
        $purchase->discount = $request->discount;
        $purchase->total_price = ($request->supplied_price * $request->supplied_qty) - $request->discount;
        $purchase->current_qty = $product->qty;
        $purchase->receiver_id = \Auth::id();
        $purchase->truck_no = strtoupper($request->truck_no);
        $purchase->damage_prod = $request->damage_prod;
        $purchase->receipt_img = uploadImage($request);


        //return response()->json($purchase);


        if ($purchase->save()) {

            $request->supplied_qty = $request->supplied_qty - $request->damage_prod;
            $product->qty = $product->qty + $request->supplied_qty;
            $product->save();

            flash('Successfully Added')->success();

            return redirect()->route('purchase.index');
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
        $purchase = Purchase::with('user', 'supplier', 'product')->where('id', $id)->first();

        //return response()->json($purchase);

        return view('admin.purchases.show')->with('purchase', $purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $purchase = Purchase::with('user', 'supplier', 'product')->where('id', $id)->first();

        //return response()->json($purchase);

        return view('admin.purchases.edit')->with([
            'purchase' => $purchase,
            'suppliers' => $suppliers,
            'products' => $products
        ]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'supplier_name' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|string',
            'prod_id' => 'required|string',
            'supplied_qty' => 'required|numeric',
            'supplied_price' => 'required|string',
            'discount' => 'required|string',
            'damage_prod' => 'required|numeric',
            'avatar' => 'sometimes|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));

        $product = Product::findOrFail($request->prod_id);

        $purchase = Purchase::findOrFail($id);
        $request->supplier_name ? $purchase->supplier_name = $request->supplier_name : null;
        $request->supplier_id ? $purchase->supplier_id = $request->supplier_id : null;
        $purchase->prod_id = $request->prod_id;
        $current_qty = $purchase->supplied_qty;
        $purchase->supplied_qty = $request->supplied_qty;
        $purchase->supplied_price = $request->supplied_price;
        $purchase->discount = $request->discount;
        $purchase->total_price = ($request->supplied_price * $request->supplied_qty) - $request->discount;
        $purchase->current_qty = $product->qty;
        $purchase->receiver_id = \Auth::id();
        $purchase->truck_no = strtoupper($request->truck_no);

        $current_damaged = $purchase->damage_prod;
        $purchase->damage_prod = $request->damage_prod;
        $purchase->receipt_img = uploadImage($request);

        if ($request->has('avatar')){
            Storage::disk('public')->delete($purchase->receipt_img);
            $purchase->receipt_img = uploadImage($request);
        }

        //return response()->json($purchase);


        if ($purchase->save()) {

            if($current_damaged < $request->damage_prod){
                $new_damaged = $request->damage_prod - $current_damaged;
                $product->qty = $product->qty - $new_damaged;
            }elseif ($current_damaged > $request->damage_prod){
                $new_damaged = $current_damaged - $request->damage_prod;
                $product->qty = $product->qty + $new_damaged;
            }
            if ($current_qty < $request->supplied_qty){
                $new_qty =  $request->supplied_qty - $current_qty;
                $product->qty = $product->qty + $new_qty;
            }elseif ($current_qty > $request->supplied_qty){
                $new_qty =  $current_qty - $request->supplied_qty;
                $product->qty = $product->qty - $new_qty;
            }
            //$product->qty = $product->qty - $request->damage_prod;
            $product->save();

            flash('Successfully Added')->success();

            return redirect()->route('purchase.index');
        }

        flash('Something went wrong')->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
