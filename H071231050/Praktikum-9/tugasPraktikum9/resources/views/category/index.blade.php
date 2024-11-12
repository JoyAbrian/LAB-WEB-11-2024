@extends('layouts.home')

@section('content')
    <div>
        <div class="flex justify-end mr-14">
            <a href="{{ route('category.create') }}"
                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Add Category</a>
        </div>
        <table class="table-auto w-11/12 border border-collapse mt-5 mx-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-4 py-2 text-center text-base font-medium text-gray-500 uppercase tracking-wider">
                        Category
                    </th>
                    <th scope="col"
                        class="px-4 py-2 text-center text-base font-medium text-gray-500 uppercase tracking-wider">
                        Description
                    </th>
                    <th scope="col"
                        class="px-4 py-2 text-center text-base font-medium text-gray-500 uppercase tracking-wider">
                        Option
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-100 border-b border-t">
                        <td class="px-4 py-2 text-center font-medium text-gray-700 tracking-wider">
                            {{ $category->name }}
                        </td>
                        <td class="px-4 py-2 text-center font-medium text-gray-700 tracking-wider">
                            {{ $category->description }}
                        </td>
                        <td class="px-4 py-2 text-center font-medium text-gray-700 tracking-wider">
                            <a href="{{ route('category.edit', $category->id) }}"
                                class="inline-block w-24 text-center hover:text-blue-700 text-gray-500 font-bold py-2 px-4 rounded">
                                <!-- Ikon pensil sederhana untuk tombol Edit -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M17.414 2.586a2 2 0 0 1 0 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 0 1 2.828 0zM2 13.586V17h3.414l9.293-9.293-2.828-2.828L2 13.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus produk?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-24 text-center hover:text-red-700 text-gray-500 font-bold py-2 px-4 rounded">
                                    <!-- Ikon tempat sampah untuk tombol Delete -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M6 7h12v12a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V7zm7-5a1 1 0 0 1 1 1v1h5a1 1 0 1 1 0 2H4a1 1 0 0 1 0-2h5V3a1 1 0 0 1 1-1h4z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
