@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Order Status Management</h2>

    <div class="mb-4 card">
        <div class="card-header">
            <strong>Order #{{ $order->id }}</strong> - Current Status: <span class="badge bg-primary">{{ $order->status }}</span>
        </div>
        <div class="card-body">
            <p><strong>User:</strong> {{ $order->name }} ({{ $order->email }})</p>
            <p><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->zip }}</p>
            <p><strong>Total:</strong> ₦{{ number_format($order->total, 2) }}</p>
        </div>
    </div>

    <h5>Update Order Status</h5>
    <form action="{{ route('admin.orders.status.update', $order->id) }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="status" class="form-label">New Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Select Status --</option>
                @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                    <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Note (optional)</label>
            <textarea name="note" id="note" class="form-control" rows="2"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Status</button>
    </form>

    <h5>Status History</h5>
    <table class="table table-bordered">
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
                    <td colspan="3" class="text-center">No status changes yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
