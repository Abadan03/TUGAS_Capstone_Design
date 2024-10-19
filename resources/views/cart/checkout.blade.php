@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Checkout</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($cartItems->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($cartItems as $cart)
                        <tr>
                            <td>{{ $cart->product->nama }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp. {{ number_format($cart->product->harga, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($cart->product->harga * $cart->quantity, 0, ',', '.') }}</td>
                            @php
                                // Tambahkan total harga dari setiap item di keranjang
                                $total += $cart->product->harga * $cart->quantity;
                            @endphp
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Total Keseluruhan: Rp {{ number_format($total, 0, ',', '.') }}</h3>

            <!-- Tombol Checkout -->
            <form action="{{ route('processCheckout') }}" method="POST" id="checkoutForm">
                @csrf
                <button type="submit" class="btn btn-primary">Lanjutkan ke Pembayaran</button>
            </form>

        @else
            <h3>Keranjang Anda kosong!</h3>
        @endif
    </div>

    <!-- Script untuk validasi minimum quantity -->
    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function (e) {
            let cartItems = @json($cartItems);
            let valid = true;

            cartItems.forEach(function (item) {
                if (item.quantity < 30) {
                    valid = false;
                    alert('Jumlah untuk produk ' + item.product.name + ' kurang dari 30. Harap tambahkan lebih banyak.');
                    e.preventDefault(); // Mencegah submit form
                }
            });

            if (!valid) {
                e.preventDefault(); // Jika tidak valid, mencegah submit form
            }
        });
    </script>
@endsection
