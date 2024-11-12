@extends('templates/master')

@section('title', 'Tambah Inventory Log')

@section('header-button')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 font-weight-bold">Form Inventory Log</h2>
        <a href="{{ url('/inventory-log') }}" class="btn btn-primary">
            Kembali
        </a>
    </div>
@endsection

@section('content')
    <form action="{{ url('/inventory-log') }}" method="POST" class="mt-4">
        @csrf

        <!-- Product ID -->
        <div class="mb-3 row">
            <label for="product_id" class="col-sm-2 col-form-label">PRODUCT</label>
            <div class="col-sm-10">
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Type -->
        <div class="mb-3 row">
            <label for="type" class="col-sm-2 col-form-label">TYPE</label>
            <div class="col-sm-10">
                <select name="type" id="type" class="form-control" required>
                    <option value="restock">Restock</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
        </div>

        <!-- Quantity -->
        <div class="mb-3 row">
            <label for="quantity" class="col-sm-2 col-form-label">QUANTITY</label>
            <div class="col-sm-10">
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" class="form-control" required>
            </div>
        </div>

        <!-- Date -->
        <div class="mb-3 row">
            <label for="date" class="col-sm-2 col-form-label">DATE</label>
            <div class="col-sm-10">
                <input type="date" id="date" name="date" value="{{ old('date') }}" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">
            Simpan
        </button>
    </form>
@endsection
