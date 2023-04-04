<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::withRelationships(request('with'))
        ->search(request('name'))
        ->orderBy(request('sort', 'name'), request('order', 'asc'))
        ->simplePaginate(request('limit'))
        ->withQueryString();
    }
    
    public function show(Category $category)
    {
        return $category->loadRelationships(request('with'));
    }

}