<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('front.pages.checkout')->with('categories', $categories);
    }
}
