<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fastcart</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-gray-100">

    <!-- Header -->
    <header class="w-full bg-white shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between p-4 mx-auto max-w-7xl">
            <h1 class="text-2xl font-bold">🚀 Fastcart</h1>

            <nav class="flex gap-4 text-sm">
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hover:underline">Register</a>
                    @endif
                @endauth
                
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                    Cart
                    @php
                        $cart = session('cart', []);
                        $cartCount = array_sum(array_column($cart, 'quantity'));
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-5 h-5 text-xs font-bold leading-none text-white transform translate-x-2 -translate-y-2 bg-red-600 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-20 text-white bg-gradient-to-r from-green-400 to-blue-500">
        <div class="px-6 mx-auto text-center max-w-7xl">
            <h2 class="mb-4 text-4xl font-bold">Welcome to Fastcart</h2>
            <p class="mb-6 text-lg">Discover amazing products at unbeatable prices!</p>
            <a href="#products" class="px-6 py-3 font-semibold text-green-600 transition bg-white rounded-full hover:bg-gray-100">
                Shop Now
            </a>
        </div>
    </section>

    <!-- Products Section -->
    <main id="products" class="flex-1 p-6 mx-auto max-w-7xl">
        <h2 class="mb-8 text-3xl font-semibold">Shop Our Products</h2>

        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($products as $product)
                <div class="overflow-hidden transition bg-white rounded-lg shadow-md dark:bg-gray-800 hover:shadow-lg">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-48" />
                    <div class="p-4">
                        <h3 class="mb-2 text-lg font-semibold">{{ $product->name }}</h3>
                        <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">{{ $product->description }}</p>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-green-600">${{ number_format($product->price, 2) }}</span>

                            <!-- Add to Cart Form -->
                            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-sm text-white bg-green-500 rounded hover:bg-green-600">
                                    Add to Cart
                                </button>
                            </form>
                            <!-- End Form -->

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <footer class="w-full p-4 mt-10 text-xs text-center text-gray-500">
        © {{ date('Y') }} Fastcart. All rights reserved.
    </footer>

</body>
</html>
