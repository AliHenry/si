<?php

namespace App\Http\Controllers;

use App\Product;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('admin.supplier.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.store');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'featured' => 'sometimes|string',
        ));

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->description = $request->description;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->featured = $request->featured && $request->featured === 'on' ? true : false ;


        if ($supplier->save()) {

            flash('Successfully Added')->success();

            return redirect()->route('suppliers.index');
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
        $supplier = Supplier::findOrFail($id);

        return view('admin.supplier.show')->with('supplier', $supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('admin.supplier.edit')->with('supplier', $supplier);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'featured' => 'sometimes|string',
        ));

        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->description = $request->description;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->featured = $request->featured && $request->featured === 'on' ? true : false ;


        if ($supplier->save()) {

            flash('Successfully Updated')->success();

            return redirect()->route('suppliers.index');
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
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        flash('Supplier Deleted')->success();

        return redirect()->back();
    }
}
