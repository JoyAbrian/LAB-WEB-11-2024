@extends('templates.master')

@section('title', 'Edit Category')

@section('header-button')
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h2 class="h4">Form Category</h2>
        <a href="{{ url('/category') }}" class="btn btn-primary">
            Kembali
        </a>
    </div>
@endsection

@section('content')
    <form action="{{ url("/category/{$category->id}") }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="id" class="col-sm-2 col-form-label">ID_CATEGORY</label>
            <div class="col-sm-10">
                <input type="text" id="id" name="id" value="{{ $category->id }}"
                    class="form-control" disabled>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">NAMA</label>
            <div class="col-sm-10">
                <input type="text" id="name" name="name" value="{{ $category->name }}"
                    class="form-control">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="description" class="col-sm-2 col-form-label">DESCRIPTION</label>
            <div class="col-sm-10">
                <input type="text" id="description" name="description" value="{{ $category->description }}"
                    class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">
            Simpan
        </button>
    </form>
@endsection
