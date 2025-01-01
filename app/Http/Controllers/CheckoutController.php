<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class CheckoutController extends Controller
{
    public function index()
    {
        // Retrieve cart items from the session
        $cartItems = session()->get('cart', []);
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function processCheckout(Request $request)
    {
        // Validate the request
        $request->validate([
            'total' => 'required|numeric',
        ]);

        // Create a new payment record
        $transaction = Payment::create([
            'order_id' => uniqid(), // Use a unique order ID
            'price' => $request->total,
            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'status' => 'pending',
        ]);

        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Prepare the transaction parameters
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->order_id,
                'gross_amount' => $request->total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        // Get Snap token
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            // Save the Snap token in the checkout_link field
            $transaction->checkout_link = $snapToken;
            $transaction->save(); // Save the transaction with the Snap token

            // Store the Snap token in the session (optional)
            return redirect()->route('checkout.index')->with('snapToken', $snapToken);
        } catch (\Exception $e) {
            \Log::error('Midtrans error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create payment token.']);
        }
    }

 

    public function checkout($transactionId) {
    $transaction = Payment::findOrFail($transactionId);
    
    // You can now access the Snap token
    $snapToken = $transaction->checkout_link;

    return view('checkout', compact('transaction', 'snapToken'));
}
}
