@extends('templates/master')

@section('title', 'Tambah Product')

@section('header-button')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 font-weight-bold">Form Product</h2>
        <a href="{{ url('/product') }}" class="btn btn-primary">
            Kembali
        </a>
    </div>
@endsection

@section('content')
    <form action="{{ url('/product') }}" method="POST" class="mt-4">
        @csrf
        
        <!-- Product Name -->
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">PRODUCT NAME</label>
            <div class="col-sm-10">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
            </div>
        </div>

        <!-- Category -->
        <div class="mb-3 row">
            <label for="category_id" class="col-sm-2 col-form-label">CATEGORY</label>
            <div class="col-sm-10">
                <select id="category_id" name="category_id" class="form-control" >
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Product Description -->
        <div class="mb-3 row">
            <label for="description" class="col-sm-2 col-form-label">PRODUCT DESCRIPTION</label>
            <div class="col-sm-10">
                <input type="text" id="description" name="description" value="{{ old('description') }}" class="form-control">
            </div>
        </div>

        <!-- Price -->
        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">PRICE</label>
            <div class="col-sm-10">
                <input type="number" id="price" name="price" value="{{ old('price') }}" class="form-control">
            </div>
        </div>

        <!-- Stock -->
        <div class="mb-3 row">
            <label for="stok" class="col-sm-2 col-form-label">STOCK</label>
            <div class="col-sm-10">
                <input type="number" id="stok" name="stok" value="{{ old('stok') }}" class="form-control">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success w-100">
            Simpan
        </button>
    </form>
@endsection
