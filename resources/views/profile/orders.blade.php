@extends('layouts.app')

@section('content')
<div class="max-w-4xl px-4 py-8 mx-auto">
    <h1 class="mb-6 text-2xl font-bold">Your Orders</h1>

    @forelse ($orders as $order)
        <div class="p-6 mb-6 bg-white border shadow-sm rounded-2xl">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-semibold">Order #{{ $order->id }}</h2>
                <span class="px-3 py-1 rounded-full text-sm 
                    @if ($order->status === 'pending')
                        bg-yellow-100 text-yellow-800
                    @elseif ($order->status === 'completed')
                        bg-green-100 text-green-800
                    @else
                        bg-gray-100 text-gray-700
                    @endif
                ">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <p class="mb-1 text-sm text-gray-600">
                Placed on: {{ $order->created_at->format('F j, Y - h:i A') }}
            </p>

           

            <p class="mb-4 text-sm text-gray-600">
                Shipping to: {{ $order->address }}, {{ $order->city }}, {{ $order->state }} {{ $order->zip }}
            </p>

            <ul class="divide-y">
                @foreach ($order->items as $item)
                    <li class="flex items-center justify-between py-2">
                        <div>
                            <p class="font-medium">
                                {{ $item->product->name ?? 'Product not found' }}
                                <span class="text-gray-500">× {{ $item->quantity }}</span>
                            </p>
                            <p class="text-sm text-gray-500">₦{{ number_format($item->price, 2) }} each</p>
                        </div>
                        <p class="font-semibold">
                            ₦{{ number_format($item->price * $item->quantity, 2) }}
                        </p>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4 text-lg font-bold text-right">
                Total: ₦{{ number_format($order->total, 2) }}
            </div>
            <div class="mt-4 text-right">
                <a href="{{ route('orders.status', $order->id) }}"
                   class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    View Status
                </a>
            </div>
            
        </div>
    @empty
        <p class="text-gray-600">You haven’t placed any orders yet.</p>
    @endforelse
</div>
@endsection
