<?php

namespace App\Http\Controllers;

use App\Customer;
use App\PaymentType;
use App\Product;
use App\Sell;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use jeremykenedy\LaravelRoles\Models\Role;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sells = Sell::with('user', 'customer', 'type', 'status' )->orderBy('created_at', 'DESC')->get();


        return view('admin.sells.index')->with('sells', $sells);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with('category', 'brand')->get();
        $types = PaymentType::all();
        $customers = Customer::all();

        //return response()->json($products);
        return view('admin.sells.store')->with([
            'products' => $products,
            'types' => $types,
            'customers' => $customers
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'cust_name' => 'nullable|string|max:255',
            'payment_type' => 'required|string|max:255',
            'cus_id' => 'nullable|string|max:255',
            'pos_code' => 'nullable|string|max:255',
        ));


        $sell = new Sell();
        $sell->transaction_id = getNextTransNumber();

        $sell->total_qty = Cart::count();
        $sell->tax = Cart::tax();
        $sell->sub_total = str_replace(",", "",Cart::subtotal());
        $sell->total = str_replace(",", "", Cart::total());

        $sell->user_id = \Auth::id();
        $sell->trans_type_id = $request->payment_type;
        $sell->trans_status_id = 1;

        $request->cust_name ? $sell->cust_name = $request->cust_name : null;
        $request->pos_code ? $sell->pos_code = $request->pos_code : null;
        $request->cus_id ? $sell->cus_id = $request->cus_id : null;


        if ($sell->save()) {

            //$products = [];

            foreach (Cart::content() as $cart){
                //$products[] = $cart->model->id;

                $product = Product::findOrFail($cart->model->id);
                $product->qty = $product->qty - $cart->qty;
                $product->save();

                $sell->products()->attach($cart->model->id, ['qty' => $cart->qty, 'total' => str_replace(",", "",$cart->total), 'trans_status_id' => 1]);
            }

            Cart::destroy();

            flash('Payment Successful')->success();

            return redirect()->route('sell.invoice', ['id' => $sell->id]);
            //return redirect()->route('sells.index');
        }

        flash('Something went wrong')->error();

        //return response()->json($sell);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sell = Sell::with('user', 'customer', 'type', 'status' )->where('id', $id)->first();

        $sell->products;

        return view('admin.sells.show')->with('sell', $sell);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


    public function insertCart(Request $request)
    {
        $id = Input::get('prod_id');
        $name = Input::get('name');
        $price = Input::get('price');


        $duplicates = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($duplicates->isNotEmpty()){

            flash('Item is already in your cart')->success();

            return response()->json(['success' => true]);
        }

        Cart::add($id, $name, 1, $price)->associate('App\Product');

        flash('Item was added to your cart')->success();

        return response()->json(['success' => true]);
    }

    public function updateCart()
    {
        $id = Input::get('row_id');
        $qty = Input::get('qty');

        Cart::update($id, $qty);

        return response()->json(['success' => true]);
    }


    public function destroyCart()
    {
        $id = Input::get('row_id');

        Cart::remove($id);

        flash('Item has been removed')->success();

        return response()->json(['success' => true]);

    }

    public function paymentInvoice($id)
    {
        $sell = Sell::with('user', 'customer', 'type', 'status' )->where('id', $id)->first();

        $sell->products;

        return response()->json($sell);
        //return view('admin.invoice.invoice')->with('sell', $sell);

    }
}
