@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Admin Dashboard</h2>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="p-4 bg-blue-600 text-white rounded-lg shadow">
            <div class="text-sm font-medium">Total Orders</div>
            <div class="text-3xl font-semibold">{{ $totalOrders }}</div>
        </div>
        <div class="p-4 bg-yellow-500 text-white rounded-lg shadow">
            <div class="text-sm font-medium">Pending Orders</div>
            <div class="text-3xl font-semibold">{{ $pendingOrders }}</div>
        </div>
        <div class="p-4 bg-green-600 text-white rounded-lg shadow">
            <div class="text-sm font-medium">Products</div>
            <div class="text-3xl font-semibold">{{ $totalProducts }}</div>
        </div>
        <div class="p-4 bg-gray-800 text-white rounded-lg shadow">
            <div class="text-sm font-medium">Users</div>
            <div class="text-3xl font-semibold">{{ $totalUsers }}</div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white shadow rounded-lg p-4">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Recent Orders</h4>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $order->id }}</td>
                            <td class="px-4 py-2">{{ $order->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2 capitalize">{{ $order->status }}</td>
                            <td class="px-4 py-2">₦{{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-2">{{ $order->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">No recent orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
