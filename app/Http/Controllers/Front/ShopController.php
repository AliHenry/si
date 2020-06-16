<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop()
    {
        $pagination = 6;
        $categories = Category::with('children', 'parent')->orderBy('name', 'ASC')->get();
        //$products = Product::where('featured', true)->paginate(9);


        if(request()->category)
        {
            $products = Product::whereHas('categories',  function ($query){
                $query->where('slug', request()->category);
            });
            //$categoryName = optional($categories->where('slug', request()->category)->first())->name;

        }elseif (request()->input('query'))
        {
            $query = request()->input('query');
            $products = Product::where('featured', true)->where('name', 'like', "%$query%");
            //$categoryName = 'Search Result';

        } else{
            $products = Product::where('featured', true);
            //$categoryName = 'Featured Item';
        }

        $products = $products->paginate($pagination);
        //return response()->json($categories);

        return view('front.pages.shop')->with([
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
