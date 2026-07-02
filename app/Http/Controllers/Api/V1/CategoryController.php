<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreateCategoryRequest;
use App\Http\Requests\Api\V1\UpdateCategoryRequest;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); 
        return $this->successResponse($categories, 'Categories fetched successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $validated = $request->validated();
        $category = Category::create($validated);
        return $this->successResponse($category, 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->successResponse($category, 'Category fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->update($validated);
        return $this->successResponse($category, 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->successResponse(null, 'Category deleted successfully');
    }
}
