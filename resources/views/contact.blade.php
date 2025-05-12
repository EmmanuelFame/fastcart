@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Contact Us</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block mb-1 font-medium" for="name">Name</label>
            <input type="text" name="name" id="name" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="email">Email</label>
            <input type="email" name="email" id="email" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="message">Message</label>
            <textarea name="message" id="message" rows="4" required
                      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"></textarea>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
            Send Message
        </button>
    </form>
</div>
@endsection
