@extends('layouts.app')

@section('content')
<div class="">
    <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Tambah Produk Baru</h1>
      <img src="{{asset('images/logo-telkom.jpg')}}" alt="" width="100">
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
        </div>
        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" class="form-control" id="harga" name="harga" required step="0.01" min="0">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
        </div>
        <div class="mb-3">
          <label for="gambar" class="form-label">Upload Gambar</label>
          <input type="file" class="form-control" id="gambar" name="gambar">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
