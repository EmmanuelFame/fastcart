@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Order Status</h2>

    <div class="mb-4 card">
        <div class="card-header">
            <strong>Order #{{ $order->id }}</strong>
            <span class="badge bg-primary float-end">{{ ucfirst($order->status) }}</span>
        </div>
        <div class="card-body">
            <p><strong>Shipping Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->zip }}</p>
            <p><strong>Total:</strong> ₦{{ number_format($order->total, 2) }}</p>
            <p><strong>Placed On:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <h5>Status History</h5>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Status</th>
                <th>Note</th>
                <th>Changed At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
                <tr>
                    <td>{{ ucfirst($log->status) }}</td>
                    <td>{{ $log->note ?? '-' }}</td>
                    <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No status updates yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
