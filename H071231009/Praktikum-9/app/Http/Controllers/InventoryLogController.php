<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InventoryLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = InventoryLog::all();
        return view('inventory-log.indexInventoryLog', [
            'inventorylogs' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Product::all();
        return view('inventory-log.createInventoryLog', [
            'products' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simpan data input sementara agar dapat ditampilkan kembali jika ada validasi yang gagal
        Session::flash('product_id', $request->product_id);
        Session::flash('type', $request->type);
        Session::flash('quantity', $request->quantity);
        Session::flash('date', $request->date);

        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ], [
            'product_id.required' => 'Product ID harus diisi!',
            'product_id.exists' => 'Product ID tidak valid!',
            'type.required' => 'Type harus diisi!',
            'type.in' => 'Type harus berupa "restock" atau "sold"!',
            'quantity.required' => 'Quantity harus diisi!',
            'quantity.integer' => 'Quantity harus berupa angka!',
            'quantity.min' => 'Quantity harus minimal 1!',
            'date.required' => 'Tanggal harus diisi!',
            'date.date' => 'Format tanggal tidak valid!',
        ]);

        // Buat entri InventoryLog
        $data = [
            'product_id' => $request->product_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ];

        InventoryLog::create($data);

        // Ambil produk terkait
        $product = Product::find($request->product_id);

        // Periksa jenis entri dan sesuaikan stok
        if ($request->type === 'restock') {
            $product->stok += $request->quantity; // Tambah stok
        } elseif ($request->type === 'sold') {
            $product->stok -= $request->quantity; // Kurangi stok
            // Pastikan stok tidak negatif
            if ($product->stok < 0) {
                return redirect()->back()->withErrors(['Stok produk tidak boleh negatif!']);
            }
        }

        // Simpan perubahan pada produk
        $product->save();

        // Redirect dengan pesan sukses
        return redirect()->to('/inventory-log')->with('success', 'Inventory-Log berhasil ditambahkan dan stok produk diperbarui!');
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
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        InventoryLog::where('id', $id)->delete();
        return redirect()->to('/inventory-log')->with('success', 'Product berhasil dihapus!');
    }
}
