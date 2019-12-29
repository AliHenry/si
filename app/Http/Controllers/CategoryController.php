<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::with('parent')->get();

        return view('admin.categories.index')->with('categories', $categories);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.categories.store')->with('categories', $categories);
    }


    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'parent_id' => 'sometimes',
        ));


        $category = new Category();
        $category->name = $request->name;
        $category->slug = categorySlug($request->name);
        $category->parent_id = $request->parent_id ? $request->parent_id : 0;

        if ($category->save()) {

            flash('Successfully created')->success();

            return redirect()->route('categories.index');
        }

        flash('Something went wrong')->error();
    }

    public function show($id)
    {
        $category = Category::with('parent')->where('id', $id)->first();

        return view('admin.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();

        $category = Category::with('parent')->where('id', $id)->first();

        return view('admin.categories.edit')->with([
            'categories' => $categories,
            'category' => $category
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
            'parent_id' => 'sometimes',
        ));

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = strtolower($request->name);
        $category->parent_id = $request->parent_id ?  $request->parent_id : 0 ;

        if ($category->save()) {

            flash('Successfully created')->success();

            return redirect()->route('categories.index');
        }

        flash('Something went wrong')->error();
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        flash('Category Deleted')->success();

        return redirect()->back();
    }
}
