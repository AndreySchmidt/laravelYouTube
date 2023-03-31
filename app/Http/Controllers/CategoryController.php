<?php

namespace App\Http\Controllers;

// use App\Models\categories;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with(request('with', []))
        ->search(request('name'))
        ->orderBy(request('sort', 'name'), request('order', 'asc'))
        ->simplePaginate(request('limit'))
        ->withQueryString();
    }
    
    public function show(Category $category)
    {
        return $category->load(request('with', []));
    }

}