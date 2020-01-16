<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\StoreAudit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class StoreAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeAudits = StoreAudit::with('store', 'user')->get();

        return view('admin.storeAudit.index')->with('storeAudits', $storeAudits);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.storeAudit.store')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $defaultBalance = 0;

        $category = $request->category;

        $storeAudit = StoreAudit::where('cate_id', $category)->whereDay('created_at', Carbon::now()->day)->first();
        if ($storeAudit){

            return redirect()->route('audits.edit', [$storeAudit]);
        }
        $products = Product::where('cate_id', $category)->get();
        $productCount = Product::where('cate_id', $category)->count();

        $audit = new StoreAudit();
        $audit->cate_id = $category;
        $audit->user_id = \Auth::id();
        $audit->balanced = $defaultBalance;
        $audit->unbalanced = $productCount;
        $audit->note = '';

        if($audit->save()){
            foreach ($products as $product){
                $audit->products()->attach($product->id, ['balanced' => false, 'missing' => 0, 'note' => 'none']);
            }
        }


        return redirect()->route('audits.edit', [$audit]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audit = StoreAudit::with('store', 'user')->where('id', $id)->first();

        $audit->products;

        //return response()->json($audits);

        return view('admin.storeAudit.show')->with('audit', $audit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audit = StoreAudit::with('store', 'user')->where('id', $id)->first();

        $audit->products;

        //return response()->json($audits);

        return view('admin.storeAudit.edit')->with('audit', $audit);
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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $audit = StoreAudit::findOrFail($id);
        $audit->products()->detach();
        $audit->delete();
        flash('Store Audit Deleted')->success();

        return redirect()->back();
    }

//    /**
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function fetchProduct()
//    {
//        $defaultBalance = 0;
//
//        $category = Input::get('category');
//
//        $storeAudit = StoreAudit::where('cate_id', $category)->whereDay('created_at', Carbon::now()->day)->first();
//        if ($storeAudit){
//
//            return response()->json($storeAudit->products);
//        }
//        $products = Product::where('cate_id', $category)->get();
//        $productCount = Product::where('cate_id', $category)->count();
//
//        $audit = new StoreAudit();
//        $audit->cate_id = $category;
//        $audit->user_id = \Auth::id();
//        $audit->balanced = $defaultBalance;
//        $audit->unbalanced = $productCount;
//        $audit->note = '';
//
//        if($audit->save()){
//            foreach ($products as $product){
//                $audit->products()->attach($product->id, ['balanced' => false, 'missing' => 0, 'note' => 'none']);
//            }
//        }
//
//
//        return response()->json($products);
//    }

    public function verifyProduct(Request $request)
    {
        $audit_id = $request->audit;
        $product_id = $request->product;

        $audit = StoreAudit::findOrFail($audit_id);
        $audit->products()->updateExistingPivot($product_id, ['balanced' => true, 'note' => 'none']);
        $audit->balanced = $audit->balanced + 1;
        $audit->unbalanced = $audit->unbalanced - 1;
        $audit->save();

        return response()->json(['status' => true]);

    }

    public function unverifyProduct(Request $request)
    {
        $audit_id = $request->audit;
        $product_id = $request->product;
        $missingQty = $request->missing;
        $note = $request->note;

        $audit = StoreAudit::findOrFail($audit_id);
        $audit->products()->updateExistingPivot($product_id, ['balanced' => false, 'missing' => $missingQty, 'note' => $note]);

        return response()->json(['status' => true]);

    }

    public function editStoreAudit()
    {
        $audit_id = Input::get('audit_id');
        $prod_id = Input::get('prod_id');
        $balanced = Input::get('balance');
        $missingQty = 0;
        $note = 'None';


//        $data = [
//            'audit' => $audit_id,
//            'product' => $prod_id,
//            'balanced' => $balanced,
//            'note' => $note
//        ];


        $audit = StoreAudit::findOrFail($audit_id);
        if ($balanced == 1){
            $audit->balanced = $audit->balanced + 1;
            $audit->unbalanced = $audit->unbalanced - 1;
        }else{
            $audit->balanced = $audit->balanced - 1;
            $audit->unbalanced = $audit->unbalanced + 1;
        }

        if ($audit->save()){
            $audit->products()->updateExistingPivot($prod_id, ['balanced' => $balanced, 'missing' => $missingQty, 'note' => $note]);
        }

        return response()->json($audit);
    }

    public function reportStoreAudit()
    {
        $audit_id = Input::get('audit_id');
        $prod_id = Input::get('prod_id');
        $balanced = false;
        $missingQty = Input::get('missing');
        $note = 'The data is not balanced. Please check';


//        $data = [
//            'audit' => $audit_id,
//            'product' => $prod_id,
//            'balanced' => $balanced,
//            'missing' => $missingQty,
//            'note' => $note
//        ];


        $audit = StoreAudit::findOrFail($audit_id);
        $audit->products()->updateExistingPivot($prod_id, ['balanced' => $balanced, 'missing' => $missingQty, 'note' => $note]);

        return response()->json($audit);
    }
}
