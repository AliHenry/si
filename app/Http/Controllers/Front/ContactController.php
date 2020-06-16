<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $categories = Category::with('children', 'parent')->orderBy('name', 'ASC')->get();
        //return response()->json($categories);
        return view('front.pages.contact')->with([
            'categories' => $categories
        ]);
    }
}
