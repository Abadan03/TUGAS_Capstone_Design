<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Models\Order;
use App\Models\Payment;

use Midtrans\Config;


class PaymentController extends Controller
{
    //
    public function payments(Request $request){
        // Log::info('Request Data payments: ', $request->all());
        $order = Order::where('order_id', $request->order_id)->first();
        // $order = Order::find($request->order_id);
        Log::info('Request Order ========================== SEJASDASDASDASDBASDBAS: ', [$order]);

    
        
        // return redirect()->route('payments.index');
        return view('payments.index', compact('order'));
    }

    public function createPayment(Request $request) {
        Log::info('Request Data create payments: ', $request->all());

       
        $username = Auth::user()->name;
        $order = Order::where('order_id', $request->order_id)->first();
        $order->status = 4;
        $order->save();
        $test = $request->validate([
            'order_id' => 'required|string|max:255',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
        Log::info('Order :', $test);

        $path = null;
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $imagePath = Storage::disk('public')->put('payment_proof', $file);

            $path = $file->storeAs(
                'payment_proof', 
                $file->getClientOriginalName(), 
                'public' 
            ); 
        }
        // Log::info('Path :', $path);

        $createpayment = new Payment();
        $createpayment->order_id = $request->order_id;
        $createpayment->status = $order->status;
        $createpayment->price = $order->amount;
        $createpayment->item_name = $order->nama_produk;
        $createpayment->customer_name = $username;
        $createpayment->payment_proof = $path;
        $createpayment->save();
        return redirect()->route('orders.index')->with('success', 'Pembayaran berhasil, menunggu Approval!');



    }
}
