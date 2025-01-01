<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\Letter;
use App\Models\Payment;


class AdminController extends Controller
{
    public function showProducts()
    {
        $products = Product::all();

        // Mengirim data produk ke view 'admin.index'
        return view('admin.index', compact('products'));
    }

    public function pesanan() {
        $orders = Order::all();

        return view('admin.order.index', compact('orders'));
    }

    public function checkletter(Request $request) {
        Log::info('Request Data: ', $request->all());

        // $order_id = $request->id
        $orderId = $request->order_id;
        $order = Order::find($orderId);
        
        $letter = Letter::find($orderId);
        Log::info('Ini Letter: ', [$letter]);
        Log::info('ini order: ', [$order]);

        return view('admin.order.approval', compact('order', 'letter'));
    }

    public function getpdf(Request $request) {

    }

    public function approve (Request $request) {
        Log::info('ini approve : ', $request->all());
        $order_id = $request->order_id;
        $order = Order::where('order_id', $order_id)->first();
        Log::info('ini data approve buat pembayaran : ', [$order]);


        $order->status = 3;

        $order->save();


        return redirect()->route('pesanan_pengguna')->with('success', 'Letter berhasil diapprove!');
    }

    public function decline (Request $request) {
        $order_id = $request->order_id;
        $order = Order::where('order_id', $order_id)->first();
        $order->status = 5;

        $order->save();


        return redirect()->route('pesanan_pengguna')->with('Gagal', 'Letter tidak diapprove!');
    }

    public function checkApprove (Request $request) {
        $orderId = $request->order_id;
        $order = Order::find($orderId);

        $payment = Payment::find($orderId);
        return view('admin.payments.index', compact('order', 'payment'));

    }

    public function paymentApprove (Request $request) {
        $orderId = $request->order_id;
        // Order::where('order_id', $request->order_id)->first();
        $order = Order::where('order_id', $orderId)->first();
        Log::info('ini data approve buat pembayaran : ', [$order]);
        $order->status = 0;
        $order->save();
        
        $payment = Payment::where('order_id', $orderId)->first();
        $payment->status = 0;

        $payment->save();

        // Kurangi stok produk berdasarkan jumlah yang dipesan
        $product = Product::where('nama', $order->nama_produk)->first();
        if ($product) {
            $product->stok -= $order->quantity; // Kurangi stok
            $product->save(); // Simpan perubahan stok
        }


        return redirect()->route('pesanan_pengguna')->with('success', 'Pesanan berhasil diapprove!');
    }

    public function listPayment () {
        $payments = Payment::all();
        $letters = Letter::all();
        $orders = Order::all();

        return view('admin.history.index', compact('payments', 'letters', 'orders'));
    }

    public function historyCheck (Request $request) {
        $orderId = $request->order_id;
        $payment = Payment::find($orderId);
        $letter = Letter::find($orderId);
        $order = Order::find($orderId);
        Log::info('ini data BUAT CHECK payment : ', [$payment]);
        Log::info('ini data BUAT CHECK letter : ', [$letter]);
        Log::info('ini data BUAT CHECK Order: ', [$order]);

        return view('admin.history.check', compact('payment', 'letter', 'order'));
    }
}
