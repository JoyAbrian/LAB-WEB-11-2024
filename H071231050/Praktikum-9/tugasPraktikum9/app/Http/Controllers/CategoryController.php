<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('description', $request->description);
        // Validasi input
        $request->validate([
            "name" => "required|unique:categories,name",
            "description" => "required",
        ], [
            "name.required" => "Kategori harus diisi",
            "name.unique" => "Kategori sudah terdaftar",
            "description.required" => "Deskripsi harus diisi",
        ]);

        // Menyimpan data produk jika kategori ada
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);        

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route("category.index")->with('success', 'Product created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view("category.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|unique:categories,name," . $id,
            "description" => "required",
        ], [
            "name.required" => "Kategori harus diisi",
            "name.unique" => "Kategori sudah terdaftar",
            "description.required" => "Deskripsi harus diisi",
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route("category.index")->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Category::findOrFail($id)->delete();
        return redirect()->route("category.index")->with('success', 'Category deleted successfully');
    }
}
