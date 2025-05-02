<!-- resources/views/checkout/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 bg-gray-50 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <h2 class="mb-8 text-3xl font-bold text-center">Checkout</h2>
        

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

            <!-- Order Summary -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold">Order Summary</h3>

                @php
                    $cart = session('cart', []);
                    $subtotal = collect($cart)->sum(function ($item) {
                        return $item['price'] * $item['quantity'];
                    });
                @endphp

                @if(count($cart) > 0)
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($cart as $item)
                            <li class="flex justify-between py-4">
                                <div>
                                    <p class="font-medium">{{ $item['name'] }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <p class="font-semibold">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between mt-6 text-lg font-semibold">
                        <span>Subtotal:</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="flex justify-between mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>

                    <div class="flex justify-between mt-2 text-xl font-bold">
                        <span>Total:</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Your cart is empty.</p>
                @endif
            </div>

            <!-- Billing Form -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold">Billing Details</h3>

                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block mb-1 font-medium">Full Name</label>
                        <input type="text" id="name" name="name" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-green-400">
                    </div>

                    <div>
                        <label for="email" class="block mb-1 font-medium">Email Address</label>
                        <input type="email" id="email" name="email" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-green-400">
                    </div>

                    <div>
                        <label for="address" class="block mb-1 font-medium">Address</label>
                        <input type="text" id="address" name="address" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-green-400">
                    </div>

                    <div>
                        <label for="city" class="block mb-1 font-medium">City</label>
                        <input type="text" id="city" name="city" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-green-400">
                    </div>

                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label for="state" class="block mb-1 font-medium">State</label>
                            <input type="text" id="state" name="state" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-green-400">
                        </div>
                        <div class="w-1/2">
                            <label for="zip" class="block mb-1 font-medium">ZIP</label>
                            <input type="text" id="zip" name="zip" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-green-400">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 mt-6 font-bold text-white bg-green-600 rounded hover:bg-green-700">
                        Place Order
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
