@extends('layouts.app')

@section('content')
<div class="px-4 py-8 mx-auto max-w-7xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Shopping Cart</h1>
        <a href="{{ route('home') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-300">
            Continue Shopping
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (!empty($cart))
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full text-sm text-left">
                <thead class="text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-6 py-4">Product</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Quantity</th>
                        <th class="px-6 py-4">Subtotal</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $total = 0; @endphp

                    @foreach($cart as $id => $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $item['name'] }}</td>
                            <td class="px-6 py-4">N{{ number_format($item['price'], 2) }}</td>
                            <td class="px-6 py-4">{{ $item['quantity'] }}</td>
                            <td class="px-6 py-4">N{{ number_format($subtotal, 2) }}</td>
                            <td class="flex items-center justify-center px-6 py-4 space-x-2">
                                <form action="{{ route('cart.remove', $id) }}" method="POST"  style="display: inline;" onsubmit="return confirm('Remove this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @guest
        <div class="p-4 mb-6 text-sm text-yellow-700 bg-yellow-100 rounded">
            Please <a href="{{ route('login') }}" class="font-bold underline">log in</a> to proceed to checkout.
        </div>
        @endguest 

        <div class="flex items-center justify-between mt-6">
            <div class="text-xl font-bold">Total: N{{ number_format($total, 2) }}</div>
            <a href="{{ route('checkout.index') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                Proceed to Checkout
            </a>
            <a href="{{ route('checkout.pod.form') }}" 
   class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:ring-gray-400">
    Pay on Delivery
</a>


        </div>

    @else
        <div class="p-6 text-center text-gray-500 bg-white rounded-lg shadow">
            Your cart is empty. <br>
            <a href="{{ route('admin.products.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                Browse Products
            </a>
        </div>
    @endif
</div>
@endsection
