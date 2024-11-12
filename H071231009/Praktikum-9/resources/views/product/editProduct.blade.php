@extends('templates.master')

@section('title', 'Edit Product')

@section('header-button')
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h2 class="h4">Form product</h2>
        <a href="{{ url('/product') }}" class="btn btn-primary">
            Kembali
        </a>
    </div>
@endsection

@section('content')
    <form action="{{ url("/product/{$product->id}") }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="id" class="col-sm-2 col-form-label">ID_product</label>
            <div class="col-sm-10">
                <input type="text" id="id" name="id" value="{{ $product->id }}"
                    class="form-control" disabled>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">PRODUCT NAME</label>
            <div class="col-sm-10">
                <input type="text" id="name" name="name" value="{{ $product->name }}"
                    class="form-control">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="category_id" class="col-sm-2 col-form-label">CATEGORY</label>
            <div class="col-sm-10">
                <select id="category_id" name="category_id" class="form-control" >
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="description" class="col-sm-2 col-form-label">PRODUCT DESCRIPTION</label>
            <div class="col-sm-10">
                <input type="text" id="description" name="description" value="{{ $product->description }}"
                    class="form-control">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">PRICE</label>
            <div class="col-sm-10">
                <input type="text" id="price" name="price" value="{{ $product->price }}"
                    class="form-control">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="stok" class="col-sm-2 col-form-label">STOCK</label>
            <div class="col-sm-10">
                <input type="text" id="stok" name="stok" value="{{ $product->stok }}"
                    class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">
            Simpan
        </button>
    </form>
@endsection
