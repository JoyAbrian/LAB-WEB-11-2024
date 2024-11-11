@extends('templates/master')

@section('title', 'Tambah Category')

@section('header-button')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 font-weight-bold">Form Category</h2>
        <a href="{{ url('/category') }}" class="btn btn-primary">
            Kembali
        </a>
    </div>
@endsection

@section('content')
    <form action="{{ url('/category') }}" method="POST" class="mt-4">
        @csrf
        

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">CATEGORY NAME</label>
            <div class="col-sm-10">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="description" class="col-sm-2 col-form-label">DESCRIPTION</label>
            <div class="col-sm-10">
                <input type="text" id="description" name="description" value="{{ old('description') }}"
                    class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">
            Simpan
        </button>
    </form>
@endsection
