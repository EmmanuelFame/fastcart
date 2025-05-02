<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Cart;

class MergeCartAfterLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);

        if (empty($sessionCart)) {
            return;
        }

        foreach ($sessionCart as $productId => $item) {
            $cartItem = Cart::where('user_id', $user->id)
                            ->where('product_id', $productId)
                            ->first();

            if ($cartItem) {
                // If product already exists in DB cart, increment quantity
                $cartItem->quantity += $item['quantity'];
                $cartItem->save();
            } else {
                // Otherwise, create a new cart record
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        // Clear the session cart after merging
        session()->forget('cart');
    }
}
