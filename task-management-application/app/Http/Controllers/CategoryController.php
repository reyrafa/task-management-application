<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\DestroyRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('categories.index');
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
    public function store(StoreRequest $request)
    {
        $validated_request = $request->validated();
        Category::create($validated_request);
        return redirect()->back()->with('success', 'Category Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $validated_request = $request->validated();
        $category->update($validated_request);
        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
