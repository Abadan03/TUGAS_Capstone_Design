<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="/admin">Dashboard</a></li>
                <li><a href="#">Input produk</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="header">
                <h1>Admin</h1>
                <img src="/images/logo-telkom.jpg" alt="Telkom University Logo" class="logo">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->nama }}</td>
                <td>{{ $product->stok }}</td>
                <td>Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
                </tbody>
            </table>
            <div class="total">
                <p>Total Price: Rp 7.000</p>
                <button class="checkout-btn">Checkout</button>
            </div>
        </div>
    </div>
</body>
</html>
