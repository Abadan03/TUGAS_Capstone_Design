@extends('layouts.app')
@section('content')

@if (session('success'))
    <div class="alert alert-success ">
        {{ session('success') }}
    </div>
@endif


<div class="">
    <div class="topside py-4">
        <h1 class="d-flex justify-center items-center align-middle">List Barang</h1>
        <img src="{{asset('images/logo-telkom.jpg')}}" alt="" width="100">
    </div>

    <!-- Button for Input Barang -->
    <div class="my-3">
        <a href="{{ route('products.create') }}" class="btn btn-primary">Input Barang</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama Produk</th>
                <th>deskripsi</th>
                <th>Jumlah</th>
                {{-- <th>Harga</th> --}}
                {{-- <th>Total</th> --}}
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->nama }}</td>
                <td>{{ $product->deskripsi }}</td>
                <td>{{ $product->stok }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
