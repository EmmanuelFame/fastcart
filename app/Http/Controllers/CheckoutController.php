<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'address' => 'required|string',
            'city'    => 'required|string',
            'state'   => 'required|string',
            'zip'     => 'required|string',
        ]);
    
        $user = Auth::user();
        $cartItems = $user->carts()->with('product')->get();
    
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }
    
        $amount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $tx_ref = 'FCART-' . uniqid();
    
        session([
            'checkout.tx_ref' => $tx_ref,
            'checkout.meta' => [
                'name'    => $request->name,
                'email'   => $request->email,
                'address' => $request->address,
                'city'    => $request->city,
                'state'   => $request->state,
                'zip'     => $request->zip,
            ]
        ]);

      // $redirectUrl = config('services.flutterwave.redirect');

$payload = [
    'tx_ref' => $tx_ref,
    'amount' => floatval($amount),
    'currency' => 'NGN',
    'redirect_url' => 'https://mercatia.store/payment/callback',
    'payment_options' => 'card',
    'customer' => [
        'email' => $request->email,
        'name' => $request->name,
    ],
    'customizations' => [
        'title' => 'Mercatia Store',
        'description' => 'Secure payment for your Mercatia cart items',
    ],
];

    
        $response = Http::withToken(config('services.flutterwave.secret_key'))
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->post(config('services.flutterwave.base_url') . '/payments', $payload);
    
        if ($response->successful()) {
            return redirect($response->json()['data']['link']);
        }
    
        Log::error('Flutterwave Init Failed', [
            'payload' => $payload,
            'response_body' => $response->body(),
            'response_status' => $response->status(),
            'response_json' => $response->json(),
        ]);
    
        return back()->withErrors(['message' => 'Failed to initialize payment.']);
    }


    public function handleCallback(Request $request)
    {
        $status = $request->query('status');
        $tx_ref = $request->query('tx_ref');
        $transaction_id = $request->query('transaction_id');

        if ($status === 'successful') {
            $user = Auth::user();
            $cartItems = $user->carts()->with('product')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('checkout.index')->with('error', 'Cart is empty after payment.');
            }

            $meta = session('checkout.meta', []);
            $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

            DB::transaction(function () use ($user, $cartItems, $meta, $total) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'name'    => $meta['name'] ?? 'Guest',
                    'email'   => $meta['email'] ?? $user->email,
                    'address' => $meta['address'] ?? '',
                    'city'    => $meta['city'] ?? '',
                    'state'   => $meta['state'] ?? '',
                    'zip'     => $meta['zip'] ?? '',
                    'total'   => $total,
                    'status'  => 'paid',
                ]);

                foreach ($cartItems as $item) {
                    $order->items()->create([
                        'product_id' => $item->product->id,
                        'quantity'   => $item->quantity,
                        'price'      => $item->product->price,
                    ]);
                }

                $user->carts()->delete();
            });

            session()->forget(['checkout.tx_ref', 'checkout.meta']);

            return redirect()->route('checkout.success')->with([
                'tx_ref' => $tx_ref,
                'transaction_id' => $transaction_id,
                'message' => 'Payment successful, order placed!',
            ]);
        }

        Log::warning('Flutterwave payment failed or cancelled', [
            'tx_ref' => $tx_ref,
            'status' => $status,
            'transaction_id' => $transaction_id,
        ]);

        return redirect()->route('checkout.failed')->with([
            'tx_ref' => $tx_ref,
            'status' => $status,
            'error' => 'Payment failed or cancelled.',
        ]);
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function failed()
    {
        return view('checkout.failed');
    }
}
