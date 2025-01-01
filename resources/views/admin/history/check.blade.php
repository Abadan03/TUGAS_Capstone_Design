@extends('layouts.app')
@section('content')

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Cek Bukti Berkas Pesanan</h1>
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
      <p class="text-start">Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
    </div>
    <div>
      <h4 class="fw-semibold">Status</h4>
      @if ($order->status === 0)
        <p class="text-start">Pesanan Sukses!</p>
      @elseif ($order->status === 5) 
        <p class="text-start">Pesanan Gagal!</p>
      @endif
    </div>
    <div>
      <h4 class="fw-semibold">Bukti Surat</h4>
      @if ($letter)
        <iframe src="{{ asset('storage/' . $letter->letter) }}" width="800px" height="600px" frameborder="0"></iframe>
      @else
        <p>No letter found.</p>
       @endif
    </div>
    <div>
      <h4 class="fw-semibold">Bukti Pembayaran</h4>
      {{-- asset('storage/' . $letter->letter) --}}
      @if (!isset($payment))  
      <div>
        Pesanan Gagal
      </div>
      @else
        <img src="{{ asset('storage/' . $payment->payment_proof) }}" alt="" width="500px" height="800px">
      @endif
    </div>
    
    
    <div class="d-flex gap-2 my-4">
      <a href="{{route('payments.list')}}">
        <button class="btn btn-info text-light">Back</button>
      </a>
    </div>
    {{-- @endforeach --}}
  </div>
</div>

@endsection