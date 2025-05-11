@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="p-8 text-center bg-white rounded-lg shadow-lg dark:bg-gray-800">
        <h1 class="text-3xl font-bold text-red-600">Payment Failed</h1>

        <p class="mt-4 text-gray-600 dark:text-gray-300">
            We could not process your payment.
        </p>

        @if(isset($tx_ref) && isset($status))
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Reference: <strong>{{ $tx_ref }}</strong> |
                Status: <strong>{{ $status }}</strong>
            </p>
        @endif

        <a href="{{ route('checkout.index') }}"
           class="inline-block px-6 py-3 mt-6 font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
            Try Again
        </a>
    </div>
</div>
@endsection
