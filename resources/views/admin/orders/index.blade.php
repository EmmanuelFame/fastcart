@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">All Orders</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#Order ID</th>
                <th>User</th>
                <th>Status</th>
                <th>Total</th>
                <th>Placed At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>₦{{ number_format($order->total, 2) }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.status.show', $order->id) }}" class="btn btn-sm btn-info">
                            View / Update
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
