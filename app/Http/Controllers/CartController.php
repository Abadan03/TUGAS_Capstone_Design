<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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
        // Ambil session_id pengguna atau user_id jika ada user login
        $userId = auth()->check() ? auth()->user()->id : $request->session()->getId();

        // Ambil data produk yang ada di keranjang berdasarkan session atau user_id
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        // Jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        // jika kuantitas kurang dari 30

        // Tampilkan halaman checkout
        return view('cart.checkout', compact('cartItems'));
    }
}
