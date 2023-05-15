<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Category',
            'categories'    => $categories
        ]);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if($category) {
            return response()->json([
                'success' => true,
                'message' => 'List Product By Category: '. $category->name,
                "product" => $category->products()->latest()->get()
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Data Product By Category Tidak Ditemukan',
            ], 404);

        }
    }
}
