@extends('layouts.app')
@section('content')

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Cek Surat</h1>
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
      <h4 class="fw-semibold">Surat</h4>
      {{-- <p class="text-start">{{ $letter->letter }}</p> --}}
      @if ($letter)
        <iframe src="{{ asset('storage/' . $letter->letter) }}" width="800px" height="600px" frameborder="0"></iframe>
      @else
           <p>No letter found.</p>
       @endif
    </div>
    
    <div class="d-flex gap-2 my-4">
      <form action="{{ route('approve') }}" method="POST">
        @csrf
        <input class="" type="hidden" name="order_id" id="order_id" value="{{ $order->order_id }}">
        <button type="submit" class="btn btn-success">Approve</button>
      </form>
      <form action="{{ route('decline') }}" method="POST">
        @csrf
        <input class="" type="hidden" name="order_id" id="order_id" value="{{ $order->order_id }}">
        <button type="submit" class="btn btn-danger text-light">Decline</button>
      </form>
      <a href="{{route('pesanan_pengguna')}}">
        <button class="btn btn-secondary">Cancel</button>
      </a>
    </div>
    {{-- @endforeach --}}
  </div>
</div>

@endsection