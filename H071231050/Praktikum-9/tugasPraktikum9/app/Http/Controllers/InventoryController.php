<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventoryLogs = InventoryLog::all();
        $products = Product::all();
        return view("inventoryLog.index", compact("inventoryLogs", 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view("inventoryLog.create", compact("products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        // Session::flash('product_id', $request->product_id);
        // Session::flash('quantity', $request->quantity);
        // Session::flash('type', $request->type);

        // Jika produk tidak ditemukan, redirect dengan pesan error
        if ($product == null) {
            return redirect()->route('inventoryLog.index')->with('error', 'Product not found');
        }

        // Hitung stok baru berdasarkan jenis transaksi
        if ($request->type == 'restock') {
            $newStock = $product->stock + $request->quantity;
        } elseif ($request->type == 'sold') {
            if ($product->stock >= $request->quantity) {
                $newStock = $product->stock - $request->quantity;
            } else {
                // Jika stok tidak mencukupi, redirect dengan pesan error
                return redirect()->route('inventoryLog.create')->with('error', 'Jumlah Stock Yang Ingin Di Beli Tidak Cukup');
            }
        } else {
            return redirect()->route('inventoryLog.create')->with('error', 'Type Transaksi Tidak Valid');
        }



        // Simpan data ke InventoryLog
        $inventory = InventoryLog::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'type' => $request->type,
        ]);

        // Perbarui stok produk
        $product->stock = $newStock;
        $product->save();

        // Redirect dengan pesan sukses
        return redirect()->route('inventoryLog.index')->with('success', 'Inventory log updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = InventoryLog::findOrFail($id)->delete();
        return redirect()->route('inventoryLog.index')->with('success', 'Inventory log deleted successfully');
    }
}
