@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="">
    <div class="topside py-4">
        <h1 class="d-flex justify-center items-center align-middle">Keranjangmu</h1>
        <img src="{{ asset('images/logo-telkom.jpg') }}" alt="" width="100">
    </div>

    @if(!empty($cartItems))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @php $total = 0; @endphp

                @foreach($cartItems as $cart)
                <tr>
                    <td>{{ $cart->product->nama }}</td>
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

        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $total }}">
            @foreach($cartItems as $cart)
                <input type="hidden" name="id" value="{{ $cart->id }}">
            @endforeach
            <button type="submit" class="btn btn-primary">Confirm Checkout</button>
        </form>
        {{-- <input type="hidden" name="total" value="{{ $total }}">
        <button type="submit" class="btn btn-primary" id="pay-button">Confirm Checkout</button> --}}
    @else
        <h3>Your cart is empty!</h3>
    @endif
</div>

@if(session('snapToken'))
    <p>Snap Token: {{ session('snapToken') }}</p>
@endif

@section("scripts")
{{-- <script src="https://app.sandbox.midtrans.com/snap/v1/transactions" data-client-key="SB-Mid-client-47Mb1kvUCsl453Fi"></script> --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-47Mb1kvUCsl453Fi"></script>


<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const payButton = document.getElementById('pay-button');
  
    payButton.addEventListener('click', function() {
      fetch('{{ route('cart.checkout') }}', {
    //   fetch('https://2cbf-139-195-174-248.ngrok-free.app/cart/checkout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status} - ${response.statusText}`);
        }
        return response.json();
      })
      .then(data => {
        if (data.snapToken) {
            // window.snap.embed(data.snapToken, {
            //     embedId: 'snap-container'
            // });
            window.snap.embed(data.snapToken, {
                embedId: 'snap-container',
                onSuccess: function(result) {
                    // Redirect to the specified URL after successful payment
                    // console.log(` url: ${data.redirectUrl} and result : ${result}`)
                    alert('Payment is success.');
                    return window.location.href = ''; // Redirect to orders page
                    
                },
                onPending: function(result) {
                    alert('Payment is pending.');
                    window.location.href = data.redirectUrl;
                },
                onError: function(result) {
                    alert('Payment failed: ' + result);
                },
                onClose: function() {
                    alert('Payment popup closed.');
                }
            });
        } else if (data.error) {
          console.error('Error from server:', data.error);
          alert('Error from server: ' + data.error);
        } else {
          console.error('Unexpected response from server:', data);
          alert('Unexpected response from server. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error fetching snapToken:', error);
        alert('Error fetching snapToken: ' + error.message);
      });
    });
  </script>
  @endsection

@endsection