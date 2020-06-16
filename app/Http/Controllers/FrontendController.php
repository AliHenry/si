<?php
namespace App\Http\Controllers;

use App\Category;

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
