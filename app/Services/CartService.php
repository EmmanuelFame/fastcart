<?php

namespace App\Services;

use App\Models\User; // <--- import this!
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart()
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            $cartItems = $user->carts()->with('product')->get();

            $cart = [];

            foreach ($cartItems as $item) {
                $cart[$item->product_id] = [
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ];
            }
        } else {
            $cart = session('cart', []);
        }

        return $cart;
    }
}
