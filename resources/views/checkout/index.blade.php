@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 text-gray-900 bg-gray-100">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="mb-8 text-3xl font-bold text-center">Checkout</h2>

        {{-- Validation & Session Error Display --}}
        @if(session('error'))
            <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @error('message')
            <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
                {{ $message }}
            </div>
        @enderror

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <!-- Order Summary -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-xl font-semibold">Order Summary</h3>

                @if($cartItems->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <li class="flex justify-between py-4">
                                <div>
                                    <p class="font-medium">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                </div>
                                <p class="font-semibold">
                                    ₦{{ number_format($item->product->price * $item->quantity, 2) }}
                                </p>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between mt-6 text-lg font-semibold">
                        <span>Subtotal:</span>
                        <span>₦{{ number_format($total, 2) }}</span>
                    </div>

                    <div class="flex justify-between mt-2 text-sm text-gray-500">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>

                    <div class="flex justify-between mt-2 text-xl font-bold">
                        <span>Total:</span>
                        <span>₦{{ number_format($total, 2) }}</span>
                    </div>
                @else
                    <p class="text-gray-500">Your cart is empty.</p>
                @endif
            </div>

            <!-- Billing Form -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-xl font-semibold">Billing Details</h3>

                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
                    @csrf

                    @foreach (['name', 'email', 'address', 'city', 'state', 'zip'] as $field)
                        <div>
                            <label for="{{ $field }}" class="block mb-1 font-medium">
                                {{ ucfirst($field) }}
                            </label>
                            <input
                                type="{{ $field === 'email' ? 'email' : 'text' }}"
                                id="{{ $field }}"
                                name="{{ $field }}"
                                value="{{ old($field, auth()->user()->$field ?? '') }}"
                                required
                                class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-green-400"
                            >
                            @error($field)
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <input type="hidden" name="amount" value="{{ number_format($total, 2, '.', '') }}">

                    <button type="submit"
                        class="w-full py-3 mt-6 font-bold text-white bg-green-600 rounded hover:bg-green-700
                            {{ $cartItems->count() === 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $cartItems->count() === 0 ? 'disabled' : '' }}>
                        Pay with Flutterwave
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
