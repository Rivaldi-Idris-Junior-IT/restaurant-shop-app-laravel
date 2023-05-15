<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('pages.admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug'   => Str::slug($request->name, '-')
        ]);

        if($category) {
            return redirect()->route('category.index')->with(['success' => 'Data berhasil Disimpan']);
        }else{
            return redirect()->route('category.create')->with(['error' => 'Terdapat data yang sama']);
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
    public function edit(Category $category)
    {
        return view('pages.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = Category::findOrFail($category->id);
        $category->update([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name, '-')
        ]);

        if($category) {
            return redirect()->route('category.index')->with(['success' => 'Data berhasil Di update']);
        }else{
            return redirect()->route('category.edit')->with(['error' => 'Terdapat data yang sama']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

         if($category){
            return redirect()->route('category.index')->with(['success' => 'Data berhasil dihapus']);
         }else{
            return response()->json([
                'status' => 'error'
            ]);
         }
    }
}
