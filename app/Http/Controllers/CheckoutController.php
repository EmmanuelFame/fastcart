<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
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

        // Here you would typically save the order to database
        // Order::create([
        //     'user_id' => auth()->id(),
        //     'total' => $subtotal,
        //     'address' => $request->address,
        //     // etc...
        // ]);
        // For now, just clear the cart
        session()->forget('cart');

        return redirect()->route('checkout.success')->with('message', 'Order placed successfully!');
    }

    public function success()
    {
        return view('checkout.success');
    }
}
