<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $products = Product::all();
        // $categories = Category::all();
        // return view("products.index", compact("products", "categories"));
        $categories = Category::all(); // Ambil semua kategori
        $products = Product::query(); // Mulai query produk

        // Filter berdasarkan kategori jika ada parameter category
        if ($request->has('category') && $request->category != '') {
            $products->where('category_id', $request->category);
        }

        $products = $products->get(); // Ambil semua produk setelah filtering

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("products.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('description', $request->description);
        Session::flash('price', $request->price);
        Session::flash('category_id', $request->category_id);
        Session::flash('stock', $request->stock);

        // Validasi input
        $request->validate([
            "name" => "required|unique:products,name",
            "description" => "required",
            "price" => "required|numeric",
            "category_id" => "required|exists:categories,id",
            "stock" => "required|numeric",
        ], [
            "name.required" => "Nama Produk Tidak Boleh Kosong.",
            "name.unique" => "Nama Produk Telah Ada, Lakukan pengeditan bila ingin melakukan perubahan.",
            "description.required" => "Deskripsi Tidak Boleh Kosong.",
            "price.required" => "Harga Tidak Boleh Kosong.",
            "category_id.exists" => "Kategori Tidak Terdaftar.",
            "stock.required" => "Stock Tidak Boleh Kosong.",
        ]);

        // Menyimpan data produk jika kategori ada
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
        ]);

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route("products.index")->with('success', 'Product created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view("products.edit", compact("product", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            "name" => "required|unique:products,name," . $id,
            "description" => "required",
            "price" => "required|numeric",
            "category_id" => "required|exists:categories,id",
            "stock" => "required|numeric",
        ], [
            "name.required" => "Nama Produk Tidak Boleh Kosong.",
            "name.unique" => "Nama Produk Telah Ada, Lakukan pengeditan bila ingin melakukan perubahan.",
            "description.required" => "Deskripsi Tidak Boleh Kosong.",
            "price.required" => "Harga Tidak Boleh Kosong.",
            "category_id.exists" => "Kategori Tidak Terdaftar.",
            "stock.required" => "Stock Tidak Boleh Kosong.",
        ]);

        // Menyimpan data produk jika kategori ada
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
        ]);

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route("products.index")->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Product::findOrFail($id)->delete();
        return redirect()->route("products.index")->with('success', 'Product deleted successfully');
    }
}
