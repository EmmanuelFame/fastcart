@extends('layouts.app') {{-- Assuming you're extending your main layout --}}

@section('content')
<div class="max-w-6xl px-4 py-10 mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}.</p>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        {{-- Example cards --}}
        <div class="p-6 bg-white border shadow-sm rounded-2xl">
            <h2 class="text-lg font-semibold text-gray-800">Orders</h2>
            <p class="text-sm text-gray-600">Track all your recent orders and status updates.</p>
            <a href="{{ route('profile.orders') }}" class="inline-block mt-4 text-sm font-medium text-indigo-600 hover:underline">View Orders →</a>
        </div>

        <div class="p-6 bg-white border shadow-sm rounded-2xl">
            <h2 class="text-lg font-semibold text-gray-800">Profile</h2>
            <p class="text-sm text-gray-600">Manage your account and personal details.</p>
            <a href="{{ route('profile.edit') }}" class="inline-block mt-4 text-sm font-medium text-indigo-600 hover:underline">Edit Profile →</a>
        </div>

        <div class="p-6 bg-white border shadow-sm rounded-2xl">
            <h2 class="text-lg font-semibold text-gray-800">Support</h2>
            <p class="text-sm text-gray-600">Need help? Reach out to our support team anytime.</p>
            <a href="#" class="inline-block mt-4 text-sm font-medium text-indigo-600 hover:underline">Contact Support →</a>
        </div>
    </div>
</div>
@endsection
