<?php
namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function home()
    {
        $categories = Category::with('children', 'parent')->orderBy('name', 'ASC')->get();
        //return response()->json($categories);
        return view('front.index')->with([
            'categories' => $categories
        ]);
    }
}
