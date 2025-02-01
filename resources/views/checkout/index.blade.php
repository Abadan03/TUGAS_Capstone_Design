@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="">
    <h1>Checkout</h1>

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
                @foreach($cartItems as $cart)
                <tr>
                    <td>{{ $cart['name'] }}</td>
                    <td>{{ $cart['quantity'] }}</td>
                    <td>Rp. {{ number_format($cart['price'], 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($cart['price'] * $cart['quantity'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total Price: Rp {{ number_format($total, 0, ',', '.') }}</h3>

        <!-- Checkout Button -->
        <button id="checkoutButton" class="btn btn-primary">Confirm Checkout</button>

        @section("scripts")
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-server-YzhffoWt9zXXaCuEdAPkbyZj"></script>
        <script>
            document.getElementById('checkoutButton').onclick = function () {
                fetch('{{ route('checkout.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ total: {{ $total }} })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snapToken) {
                        snap.pay(data.snapToken);
                    } else {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
            };
        </script>
        @endsection

    @else
        <h3>Your cart is empty!</h3>
    @endif
</div>
@endsection
