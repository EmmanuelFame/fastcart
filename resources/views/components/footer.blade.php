<footer class="bg-gray-100 mt-16 py-8 text-sm text-gray-600">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">
        <p>&copy; {{ now()->year }} Mercatia. All rights reserved.</p>

        <div class="flex gap-4">
            <a href="{{ route('terms') }}" class="hover:text-gray-900 transition">Terms & Conditions</a>
            <a href="{{ route('privacy') }}" class="hover:text-gray-900 transition">Privacy Policy</a>
            <a href="{{ url('/contact') }}" class="hover:text-gray-900 transition">Contact</a>
        </div>
    </div>
</footer>
