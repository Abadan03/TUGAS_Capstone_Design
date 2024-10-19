@extends('layouts.app')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@section('content')
<div class="">
    <div class="topside py-4">
        <h1 class="d-flex justify-center items-center align-middle">Keranjangmu</h1>
        <img src="{{asset('images/logo-telkom.jpg')}}" alt="" width="100">
    </div>

    @if(!empty($cartItems))
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            @php $total = 0; @endphp

                @foreach($cartItems as $cart)
                <tr>
                    <td>{{ $cart->product->nama }}</td> <!-- Ambil nama produk dari relasi -->

                    <td>
                        <form action="{{ route('cart.decrease') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $cart->id }}">
                            <button type="submit" class=""><h3>-</h3></button>
                        </form>
                        {{ $cart->quantity }}
                        <form action="{{ route('cart.increase') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $cart->id }}">
                        <button type="submit" class=""> <h3>+</h3> </button>
                    </form>
                    </td>
                    <td>Rp. {{ number_format($cart->product->harga, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($cart->product->harga * $cart->quantity, 0, ',', '.') }}</td>
                    @php
                        // Tambahkan total harga dari setiap item di keranjang
                        $total += $cart->product->harga * $cart->quantity;
                    @endphp
                    <td>
                        <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h3>Total Price: Rp {{ number_format($total, 0, ',', '.') }}</h3>

        <!-- Tombol checkout -->
        <button id="checkoutButton" class="btn btn-primary">Checkout</button>

        <script>
           
        </script>

        @else
        <h3>Your cart is empty!</h3>
    @endif
</div>

@endsection
