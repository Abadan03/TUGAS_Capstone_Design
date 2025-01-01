@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pembayaran</h1>
        <p>Memproses pembayaran, harap tunggu...</p>

        

    </div>
@endsection

@section('scripts')
<script src="https://api.sandbox.midtrans.com/v2/[ORDER_ID]/status" data-client-key="SB-Mid-client-47Mb1kvUCsl453Fi"></script>

@endsection