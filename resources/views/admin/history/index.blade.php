@extends('layouts.app')
@section('content')

@if (session('success'))
    <div class="alert alert-success ">
        {{ session('success') }}
    </div>
@endif

<div class="">
  <div class="topside py-4">
      <h1 class="d-flex justify-center items-center align-middle">Daftar Pesanan Selesai</h1>
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
                <th>Action</th> <!-- Kolom Action hanya ditampilkan sekali -->
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="">
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->nama_produk }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                
                @if ($order->status === 1) 
                  <td>Ajukan Surat</td>
                @elseif($order->status === 2)
                  <td>Menunggu approval surat</td>
                @elseif($order->status === 3) 
                  <td>Menunggu Pembayaran</td>
                @elseif($order->status === 4) 
                  <td>Menunggu approval pembayaran</td>
                @elseif($order->status === 5)
                  <td>Pesanan gagal!</td>
                @else
                  <td>Pesanan sukses</td>
                @endif
                
                <td>
                  @if ($order->status === 2)
                    <form action="{{ route('checkletter') }}" method="POST">
                      @csrf
                      <input type="hidden" name="order_id" value="{{ $order->id }}">
                      <button id="pay-button" class="btn rounded btn-info text-light">Cek Surat!</button>
                    </form>
                  @elseif ($order->status === 4)
                  <form  action="{{ route('payments.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <button type="submit" id="pay-button" class="btn rounded btn-primary text-light">Cek Pembayaran!</button>
                  </form>
                  @elseif ($order->status === 0)
                    <form  action="{{ route('history.check') }}" method="POST">
                      @csrf
                      <input type="hidden" name="order_id" value="{{ $order->id }}">
                      <button type="submit" id="pay-button" class="btn rounded btn-info text-light">Cek Berkas!</button>
                    </form>
                  @elseif ($order->status === 5)
                    <form  action="{{ route('history.check') }}" method="POST">
                      @csrf
                      <input type="hidden" name="order_id" value="{{ $order->id }}">
                      <button type="submit" id="pay-button" class="btn rounded btn-info text-light">Cek Berkas!</button>
                    </form>
                  @else
                    <span>-</span>
                  @endif
                </td>
                
                <td>{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
  @else
    <h3>Belum ada pesanan!</h3>
  @endif
</div>

@endsection
