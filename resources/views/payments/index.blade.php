@extends('layouts.app')
@section('content')

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Pembayaran</h1>
      <img src="{{ asset('images/logo-telkom.jpg') }}" alt="" width="100">
  </div>
  <div class="mt-4 text-start">
    {{-- @foreach ($orders as $order) --}}
      
    <div>
      <h4 class="fw-semibold">Nama Produk</h4>
      <p class="text-start">{{ $order->nama_produk }}</p>
    </div>
    <div>
      <h4 class="fw-semibold">Jumlah</h4>
      <p class="text-start">{{ $order->quantity }}</p>
    </div>
    <div>
      <h4 class="fw-semibold">Total Harga</h4>
      <p class="text-start">{{ number_format($order->amount, 0, ',', '.') }}</p>
    </div>
    <div>
      <h4 class="fw-semibold">Kode QR</h4>
      <img src="{{asset('images/kode_qr.jpg')}}" alt="" width="450">
    </div>
    <form action="{{ route('payments.create') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="order_id" id="order_id" value="{{ $order->order_id }}">
      <div class="mb-4">
          <label for="bukti_transfer" class="form-label fs-4 fw-semibold">Bukti Transfer</label>
          <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" placeholder="Masukkan Bukti Transfer">
      </div>
      <div class="d-flex justify-content-start gap-2">
          <button type="submit" class="btn btn-success">Confirm</button>
          <a href="{{ route('orders.index') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
          </a>
      </div>
    </form>
    {{-- @endforeach --}}
  </div>
</div>

@endsection