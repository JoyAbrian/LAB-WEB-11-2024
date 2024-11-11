<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allCategories = Category::all();

        $productsQuery = Product::query();

        if ($request->has('filter') && $request->filter != '') {
            // Periksa apakah filter kategori valid
            $productsQuery->where('category_id', $request->filter);
        }

        $products = $productsQuery->paginate(10);  // Gunakan paginate untuk pembatasan hasil

        return view('product.indexProduct', [
            'products' => $products,
            'allCategories' => $allCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Category::all();
        return view('product.createProduct', [
            'categories' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('description', $request->description);
        Session::flash('category_id', $request->category_id);
        Session::flash('price', $request->price);
        Session::flash('stok', $request->stok);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stok' => 'required|integer',
            'description' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!',
            'category_id' => 'Category Id harus diisi!',
            'price.required' => 'Price harus diisi!',
            'stok.required' => 'stock harus diisi!',
            'description.required' => 'Deskripsi harus diisi!',
        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stok' => $request->stok,
            'description' => $request->description,
        ];
        
        $product = Product::create($data);

        InventoryLog::create([
            'product_id' => $product->id,
            'type' => 'restock',
            'quantity' => $request->stok,
            'date' => now(),
        ]);
        return redirect()->to('/product')->with('success', 'Product berhasil ditambahkan!');
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
        $data = Category::all();
        $product = Product::where('id', $id)->first();
        return view('product.editProduct', [
            'product' => $product,
            'categories' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stok' => 'required|integer|min:0',
            'description' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!',
            'category_id' => 'Category Id harus diisi!',
            'price.required' => 'Price harus diisi!',
            'stok.required' => 'Stok harus diisi!',
            'description.required' => 'Deskripsi harus diisi!',
        ]);

        // Ambil data produk lama
        $product = Product::findOrFail($id);
        $oldStock = $product->stok; // Simpan stok lama untuk perbandingan

        // Update data produk
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stok = $request->stok;
        $product->save();

        // Log perubahan stok ke InventoryLog
        $newStock = $request->stok;
        $quantityChange = abs($newStock - $oldStock);

        if ($newStock < $oldStock) {
            // Jika stok baru lebih kecil, catat sebagai "sold"
            InventoryLog::create([
                'product_id' => $product->id,
                'type' => 'sold',
                'quantity' => $quantityChange,
                'date' => now(),
            ]);
        } elseif ($newStock > $oldStock) {
            // Jika stok baru lebih besar, catat sebagai "restock"
            InventoryLog::create([
                'product_id' => $product->id,
                'type' => 'restock',
                'quantity' => $quantityChange,
                'date' => now(),
            ]);
        }

        return redirect()->to('/product')->with('success', 'Product berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();
        return redirect()->to('/product')->with('success', 'Product berhasil dihapus!');
    }
}
