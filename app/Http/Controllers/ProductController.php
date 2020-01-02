<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('category', 'brand')->get();

        return view('admin.products.index')->with('products', $products);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.store')->with([
            'categories' => $categories,
            'brands' => $brands
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'measure' => 'nullable|string|max:255',
            'price' => 'required|string|max:255',
            'qty' => 'nullable|numeric',
            'discount' => 'nullable|string',
            'limit' => 'nullable|string|max:255',
            'cate_id' => 'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'featured' => 'sometimes|string',
            'avatar' => 'sometimes|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));

        $product = new Product();
        $product->name = $request->name;
        $product->slug = productSlug($request->name);
        $product->code = getNextProductNumber();
        $product->measure = $request->measure;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qty = $request->qty ? $request->qty : 0;
        $product->limit = $request->limit;
        $product->cate_id = $request->cate_id;
        $product->brand_id = $request->brand_id;
        $product->featured = $request->featured && $request->featured === 'on' ? true : false ;
        $product->image = uploadImage($request);


        if ($product->save()) {

            flash('Successfully Added')->success();

            return redirect()->route('products.index');
        }

        flash('Something went wrong')->error();

    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::with('category', 'brand')->where('id', $id)->first();

        return view('admin.products.show')->with('product', $product);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.edit')->with([
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'measure' => 'nullable|string|max:255',
            'price' => 'required|string|max:255',
            'qty' => 'nullable|numeric',
            'discount' => 'nullable|string',
            'limit' => 'nullable|string|max:255',
            'cate_id' => 'required|string|max:255',
            'brand_id' => 'nullable|string|max:255',
            'featured' => 'sometimes|string',
            'avatar' => 'sometimes|max:2000|mimes:jpeg,jpg,png',
            [
                'avatar.required' => 'Please file upload is required',
                'avatar.mimes' => 'Only jpeg, jpg, png, and pdf are allowed',
                'avatar.max' => 'Sorry! Maximum allowed size is 2MB',
            ]
        ));

        $product = Product::findOrfail($id);
        $product->name = $request->name;
        $product->slug = productSlug($request->name);
        $product->code = getNextProductNumber();
        $product->measure = $request->measure;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->limit = $request->limit;
        $product->cate_id = $request->cate_id;
        $product->brand_id = $request->brand_id;
        $product->featured = $request->featured && $request->featured === 'on' ? true : false ;

        if ($request->has('avatar')){
            Storage::disk('public')->delete($product->image);
            $product->image = uploadImage($request);
        }

        if ($product->save()) {

            flash('Successfully Updated')->success();

            return redirect()->route('products.index');
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
        $product = Product::findOrFail($id);
        $product->delete();
        flash('Role Deleted')->success();

        return redirect()->back();
    }
}
