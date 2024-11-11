@extends('templates/master')

@section('title', 'Data Inventory')

@section('header-button')
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h2 class="h4">List Inventory</h2>
        <a href="{{ url('/inventory-log/create') }}" class="btn btn-primary">
            Tambah Data Log
        </a>
    </div>
@endsection

@section('content')
    <table class="table table-bordered mt-4">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID_LOG</th>
                <th scope="col">PRODUCT NAME</th>
                <th scope="col">TYPE</th>
                <th scope="col">QUANTITY</th>
                <th scope="col">DATE</th>
                <th scope="col">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp

            @foreach ($inventorylogs as $log)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>
                        <a href="{{ url("/inventory/$log->id") }}" class="text-decoration-none text-primary">
                            {{ $log->id }}
                        </a>
                    </td>
                    <td>{{ $log->product ? $log->product->name : 'N/A' }}</td>
                    {{-- <td>{{ $log->product ? $log->product->name : 'N/A' }}</td> --}}
                    <td>{{ $log->type }}</td>
                    <td>{{ $log->quantity }}</td>
                    <td>{{ $log->date }}</td>
                    <td>
                        <form method="POST" action="{{ url("/inventory-log/$log->id") }}"
                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus data?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
