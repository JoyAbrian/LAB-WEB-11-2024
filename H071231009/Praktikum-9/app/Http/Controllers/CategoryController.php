<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        // Ambil semua kategori untuk dropdown
        $allCategories = Category::all();

        // Cek apakah filter diterapkan
        if ($request->has('filter') && $request->filter != '') {
            // Filter kategori berdasarkan id yang dipilih
            $categories = Category::where('id', $request->filter)->get();
        } else {
            // Jika tidak ada filter, ambil semua kategori
            $categories = Category::all();
        }

        return view('category.indexCategory', [
            'allCategories' => $allCategories,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.createCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('description', $request->description);

        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'description' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.unique' => 'Category sudah terdaftar!',
            'description.required' => 'Deskripsi harus diisi!',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        Category::create($data);
        return redirect()->to('/category')->with('success', 'Category berhasil ditambahkan!');
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
    public function edit(string $id)
    {
        $category = Category::where('id', $id)->first();
        return view('category.editCategory', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'description' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.unique' => 'Category sudah terdaftar!',
            'description.required' => 'Deskripsi harus diisi!',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        Category::where('id', $id)->update($data);
        return redirect()->to('/category')->with('success', 'Category  berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id', $id)->delete();
        return redirect()->to('/category')->with('success', 'Category berhasil dihapus!');
    }
}
