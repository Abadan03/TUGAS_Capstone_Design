@extends('layouts.app')

@section('content')
<div class="">
    <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Masukkan Surat Pernyataan</h1>
      <img src="{{asset('images/logo-telkom.jpg')}}" alt="" width="100">
    </div>

    <form action="{{ route('orders.createletters') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="ormawa" class="form-label">Nama Ormawa</label>
            <input type="text" class="form-control" id="ormawa" name="ormawa" required>
        </div>
        <div class="mb-3">
            <label for="acara" class="form-label">Nama Kegiatan Acara</label>
            <input type="text" class="form-control" id="acara" name="acara" required>
        </div>
        {{-- <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Jajan diinginkan</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
        </div> --}}
        <div class="mb-3">
            {{-- <label for="jumlah" class="form-label"></label> --}}
            @foreach($orders as $order)
                <input type="hidden" class="form-control" id="orders_id" name="orders_id" value="{{ $order->order_id }}">
            @endforeach
        </div>
        <div class="mb-3">
          <label for="surat" class="form-label">Upload Bukti Surat</label>
          <input type="file" class="form-control" id="surat" name="surat" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
