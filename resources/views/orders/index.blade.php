@extends('layouts.app')
@section('content')

@if (session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
@endif

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Pesananmu</h1>
      <img src="{{ asset('images/logo-telkom.jpg') }}" alt="" width="100">
  </div>

  @if(!empty($orders))
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                @foreach ($orders as $order)
                  @if($order->status === 0) 
                    @elseif ($order->status === 1)
                      <th>Action</th>
                    @elseif ($order->status === 3) 
                      <th>Action</th>
                    
                  @endif
                @endforeach

                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="">
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->nama_produk }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ number_format($order->amount, 0, ',', '.') }}</td>
                @if ($order->status === 1) 
                  <td>Ajukan Surat</td>
                @elseif($order->status === 2)
                  <td>menunggu approval surat</td>
                @elseif($order->status === 3) 
                  <td>Bayar Pesananmu!</td>
                @elseif($order->status === 4) 
                  <td>menunggu approval pembayaran</td>
                @elseif ($order->status === 5)
                  <td>Pembayaran gagal!</td>
                @else
                  <td>Pesanan sukses!</td>
                @endif
                {{-- <td>{{ $order->status }}</td> --}}
                <td>
                    @if ($order->status === 1)
                    <a href="/applyletters"">
                      <button id="pay-button" class="btn rounded btn-info text-light">Ajukan Surat!</button>
                    </a>
                  @elseif ($order->status === 3) 
                  <form action="{{ route('payments') }}" method="POST">
                      @csrf
                      <input type="hidden" name="order_id" id="order_id" value="{{ $order->order_id }}">
                      <button type="submit" id="pay-button" class="btn rounded btn-primary text-light">Bayar Sekarang!</button>
                  </form>
                  @endif
                  </td>

                <?php
                  $order->status
                ?>
                <td>{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
  @else
    <h3>Your cart is empty!</h3>
  @endif
</div>

@endsection