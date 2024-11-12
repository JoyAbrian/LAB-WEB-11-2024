@extends('layouts.home')

@section('content')
    <div>
        <div class="flex justify-end mr-14">
            <a href="{{ route('inventoryLog.create') }}"
                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Product Management</a>
        </div>
        <table class="table-auto w-11/12 border border-collapse mt-5 mx-auto">
            <thead>
                <tr class='border-b border-t'>
                    <th class="px-4 py-2 text-center text-base font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-gray-500 uppercase tracking-wider">Quantity
                    </th>
                    <th class="px-4 py-2 text-center text-base font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-gray-500 uppercase tracking-wider">Option
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventoryLogs as $inventoryLog)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center">{{ $inventoryLog->product->name }}</td>

                        <!-- Tambahkan kondisi untuk warna latar belakang hanya pada teks type -->
                        <td class="px-4 py-2 text-center">
                            <span
                                class="{{ $inventoryLog->type == 'sold' ? 'bg-red-500 text-white' : ($inventoryLog->type == 'restock' ? 'bg-green-300 text-white' : '') }} px-2 py-1 rounded-full">
                                {{ $inventoryLog->type }}
                            </span>
                        </td>

                        <td class="px-4 py-2 text-center">{{ $inventoryLog->quantity }}</td>
                        <td class="px-4 py-2 text-center">{{ $inventoryLog->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('inventoryLog.destroy', $inventoryLog->id) }}" method="POST"
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
