<?php

namespace App\Http\Controllers;

use App\models\category;

use Illuminate\Http\Request;

use App\http\requests\Categories\CreateCategoryRequest;

use App\http\requests\Categories\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index')->with('categories', category::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name'=>$request['name']
        ]);

        session()->flash('success', 'category created successfully');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('categories.create')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, category $category)
    {
        $category->update([
            'name'=>$request->name
        ]);

        session()->flash('success', 'category updated successfully');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        if ($category->posts->count()>0){
            session()->flash('error', 'cannot delete category because it has posts');

            return redirect()->back();
        }
        $category->delete();

        session()->flash('success', 'category deleted successfully');

        return redirect(route('categories.index'));
    }
}
