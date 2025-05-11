@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total:</strong> ₦{{ number_format($order->total, 2) }}</p>
        <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
        <p><strong>Placed At:</strong> {{ optional($order->placed_at)->format('d M Y, h:i A') }}</p>

        <h2 class="mt-6 font-semibold text-lg">Items:</h2>
        <ul class="mt-2 space-y-1">
            @foreach ($order->items as $item)
                <li>{{ $item->product->name }} x {{ $item->quantity }} — ₦{{ number_format($item->price, 2) }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
