<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Letter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->get();


        return view('orders.index', compact('orders')); // Kirim data pesanan ke view
    }

    public function applyletters() {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->get();
        return view('orders.applyletters', compact('orders')); 
    }

    public function createletters(Request $request) {
        Log::info('Request Data: ', $request->all());
        
        $letter = new Letter();
        $test = $request->validate([
            'ormawa' => 'required|string|max:255',
            'acara' => 'required|string|max:255',
            'orders_id' => 'required|string|max:255',
            'surat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        Log::info('Request Data: ', $test);


        $path = null;
        if ($request->hasFile('surat')) {
            $file = $request->file('surat');
            $imagePath = Storage::disk('public')->put('uploads', $file);

            $path = $file->storeAs(
                'uploads', 
                $file->getClientOriginalName(), 
                'public'
            ); 
        }
            
    
        $letter->orders_id = $request->orders_id;
        $letter->ormawa = $request->ormawa;
        $letter->event = $request->acara;
        $letter->letter = $path;
        $letter->save();

        // Update the order status
        $order = Order::where('order_id', $request->orders_id)->first(); 
        $order->status = 2; 
        $order->save();
            // return redirect()->route('orders.index')->with('success', 'Letter berhasil diupload!');

        
        return redirect()->route('orders.index')->with('success', 'Letter berhasil diupload!');
        
        // return view('orders.index');
    }
}
