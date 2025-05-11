@extends('layouts.app')

@section('content')
<div class="max-w-xl px-4 py-8 mx-auto">
    <h2 class="mb-6 text-2xl font-bold">Shipping Information (Pay on Delivery)</h2>

    <form method="POST" action="{{ route('checkout.pod') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2 border rounded">
        </div>

        <div>
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2 border rounded">
        </div>

        <div>
            <label class="block mb-1 font-medium">Address</label>
            <input type="text" name="address" required class="w-full px-4 py-2 border rounded">
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="block mb-1 font-medium">City</label>
                <input type="text" name="city" required class="w-full px-4 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 font-medium">State</label>
                <input type="text" name="state" required class="w-full px-4 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 font-medium">ZIP</label>
                <input type="text" name="zip" required class="w-full px-4 py-2 border rounded">
            </div>
        </div>

        <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-gray-700 rounded-lg hover:bg-gray-800">
            Place Order (Pay on Delivery)
        </button>
    </form>
</div>
@endsection
