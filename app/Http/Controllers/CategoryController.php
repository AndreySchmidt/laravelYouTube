<?php

namespace App\Http\Controllers;

// use App\Models\categories;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::get();
        // return Category::all();
        // return DB::table('categories')->get();
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show($categoryId)
    // {
    //     return Category::find($categoryId);
    // }
    
    public function show(Category $category)
    {
        return $category;
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, categories $categories)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(categories $categories)
    // {
    //     //
    // }
}
