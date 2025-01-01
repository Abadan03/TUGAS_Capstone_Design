<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap; // Make sure to include the Midtrans Snap class
use Midtrans\Config;
use Illuminate\Support\Facades\Log;
// use Midtrans\CoreApi;
// use Midtrans\Notification;


class CartController extends Controller
{
    public function add(Request $request)
    {
        // Pastikan user login
        $userId = Auth::id();
        // Ambil ID produk dari request
        $productId = $request->id;
        $product = Product::find($request->id);  // Ambil produk berdasarkan ID

        // Ambil produk berdasarkan ID
        $product = Product::find($productId);

        // Ambil semua item dari keranjang untuk user yang login
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();
        // Jika produk sudah ada di keranjang, tambahkan jumlahnya
        if ($cart) {
            // Jika produk sudah ada, tambahkan jumlahnya
            $cart->quantity += $request->input('quantity', 1);
            $cart->save();
        } else {
            // Jika belum ada, tambahkan item baru ke keranjang
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')
                ->where('user_id', $userId)
                ->get();

        return view('cart.index', compact('cartItems')); // Kirim data keranjang ke view
    }

    public function remove(Request $request, $id)
    {
        // Cari item di keranjang berdasarkan ID
        $cartItem = Cart::find($id);

        // Jika item ditemukan, hapus item tersebut
        if ($cartItem) {
            $cartItem->delete();
        }

        // Redirect kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function increase(Request $request)
    {
    // Ambil item keranjang berdasarkan ID
    $cartItem = Cart::find($request->id);

    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
        session()->flash('success', 'Jumlah produk berhasil ditambah!');
    }

    return redirect()->route('cart.index');
    }


    public function decrease(Request $request)
    {
        // Ambil item keranjang berdasarkan ID
        $cartItem = Cart::find($request->id);

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
                $cartItem->save();
                session()->flash('success', 'Jumlah produk berhasil dikurangi!');
            } else {
                // Jika quantity hanya 1, hapus item dari keranjang
                $cartItem->delete();
                session()->flash('success', 'Produk berhasil dihapus dari keranjang!');
            }
        }

        return redirect()->route('cart.index');
    }


    public function checkout(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();
        $productId = $request->id;

        $total = 0;
        $totalQuantity = 0; // Inisialisasi total quantity
        $nameproduct = ''; // Inisialisasi nama produk
        // Hapus item dari cart sesuai user_id dan product_id

        foreach ($cartItems as $item) {
            // Ambil nama produk berdasarkan product_id
            $product = Product::find($item->product_id);
            if ($product) {
                // Hitung total harga
                $total += $product->harga * $item->quantity; 
                // Hitung total quantity
                $totalQuantity += $item->quantity; 
                // Ambil nama produk
                $nameproduct .= $product->nama . ', '; // Gabungkan nama produk
            }
        }

        // Hapus koma terakhir jika ada
        $nameproduct = rtrim($nameproduct, ', ');

        // Order
        $order = new Order();
        $order->order_id = uniqid(); 
        $order->user_id = $userId;
        $order->nama_produk = $nameproduct; // Simpan nama produk
        $order->quantity = $totalQuantity;
        $order->amount = $total;
        $order->status = 1;
        $order->save(); // Simpan ke database

        Cart::where('user_id', $userId)->where('product_id', $productId)->delete();


        return redirect()->route('orders.index');
    }

    
    
}
