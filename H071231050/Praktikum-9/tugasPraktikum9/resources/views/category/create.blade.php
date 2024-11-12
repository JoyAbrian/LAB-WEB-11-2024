@extends('layouts.home')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-md mb-16">
        <div class="px-6 py-4">
            <h2 class="text-2xl font-bold mb-2">Edit Produk</h2>
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name :</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        required
                        value="{{ old('name') }}"> </input>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <input name="description" id="description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        required
                        value="{{ old('description') }}"></input>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('category.index') }}"
                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 mr-2">Kembali</a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection