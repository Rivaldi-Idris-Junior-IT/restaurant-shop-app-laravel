<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('pages.admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'weight' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'weight' => $request->weight,
            'price' => $request->price,
            'slug'   => Str::slug($request->title, '-')
        ]);

        if($product) {
            return redirect()->route('product.index')->with(['success' => 'Data berhasil Disimpan']);
        }else{
            return redirect()->route('product.create')->with(['error' => 'Terdapat data yang sama']);
        }
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
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('pages.admin.product.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'weight' => 'required',
            'price' => 'required',
        ]);

        $product = Product::findOrFail($product->id);
        $product->update([
            'title'   => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'weight' => $request->weight,
            'price' => $request->price,
            'slug'   => Str::slug($request->title, '-')
        ]);

        if($product) {
            return redirect()->route('product.index')->with(['success' => 'Data berhasil Disimpan']);
        }else{
            return redirect()->route('product.edit')->with(['error' => 'Terdapat data yang sama']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

         if($product){
            return redirect()->route('product.index')->with(['success' => 'Data berhasil dihapus']);
         }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
