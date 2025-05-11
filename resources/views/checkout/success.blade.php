@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="p-10 text-center bg-white rounded-lg shadow-lg dark:bg-gray-800">
        <h1 class="mb-6 text-3xl font-bold text-green-600">Thank you!</h1>

        <p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
            {{ session('message', 'Your order has been placed successfully.') }}
        </p>

        <a href="{{ route('dashboard') }}"
           class="inline-block px-6 py-3 mt-6 font-semibold text-white bg-green-600 rounded hover:bg-green-700">
            Back to Home
        </a>
    </div>
</div>
@endsection
