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

<style>
    .loader-container {
        position: fixed;
        inset: 0;
        z-index: 999;
        background-color: #0c0603;
        display: grid;
        place-content: center;
        transition: opacity .4s ease-in-out, visibility .4s ease-in-out;
    }

    .loader {
        width: 4rem;
        height: 4rem;
        border: .4rem solid #3b82f6;
        border-left-color: transparent;
        border-right-color: transparent;
        border-radius: 50%;
        animation: .8s ease infinite alternate spinner;
    }

    .loader-container.hidden {
        opacity: 0;
        visibility: hidden;
    }
    #page-content {
        opacity: 0;
        transform: translate3d(0, -1rem, 0);
        transition: opacity .6s ease-in-out, transform .6s ease-in-out;
    }

    #page-content.visible {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }

    @keyframes spinner {
        /* default values
         from{
            transform: rotate(0deg) scale(1);
        } */
        from{
            transform: rotate(1turn) scale(1.2);
        }
    }

</style>

<body class="flex flex-col min-h-screen text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-gray-100">

    <div class="loader-container">
        <div class="loader"></div>
    </div>

    <div id="page-content">

    

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
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white transform translate-x-2 -translate-y-2 bg-red-600 rounded-full">
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

    <img src="{{ asset('storage/products/untitled (3).gif') }}" class="object-cover w-full h-48" />

    <!-- Products Section -->
<main id="products" class="flex-1 p-6 mx-auto max-w-7xl">
    <h2 class="mb-8 text-3xl font-semibold">Shop by Category</h2>

    @foreach($categories as $category)
        @if($category->products->isNotEmpty())
            <section class="mb-12">
                <h3 class="mb-4 text-2xl font-bold">{{ $category->name }}</h3>

                <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($category->products as $product)
                        <div class="flex flex-col h-full overflow-hidden transition bg-white shadow rounded-xl dark:bg-gray-800 hover:shadow-lg">
                            <a href="{{ route('products.show', $product) }}" class="block">
                                <div class="w-full h-64 overflow-hidden rounded-t-xl">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="object-cover w-full h-full" />
                                </div>
                            </a>

                            <div class="flex flex-col justify-between flex-1 p-5">
                                <div>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $product->name }}
                                    </h3>
                                    @if($product->average_rating)
    <div class="mb-2 text-yellow-500">
        {!! str_repeat('⭐', round($product->average_rating)) !!}
        <span class="ml-1 text-sm text-gray-600 dark:text-gray-400">
            ({{ round($product->average_rating, 1) }}/5)
        </span>
    </div>
@else
    <div class="mb-2 text-sm text-gray-500">
        No ratings yet
    </div>
@endif

                                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                                    </p>
                                </div>

                                <span class="mb-3 font-bold text-green-600">
                                    N{{ number_format($product->price, 2) }}
                                </span>
                                
                                <div class="flex justify-between gap-2">
                                    <a href="{{ route('products.show', $product) }}"
                                       class="flex-1 px-3 py-2 text-sm font-medium text-center text-white bg-green-500 rounded hover:bg-green-600">
                                        View
                                    </a>
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-3 py-2 text-sm font-medium text-white bg-green-500 rounded hover:bg-green-600">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach
</main>

<footer class="bg-gray-800 mt-16 py-8 text-sm text-gray-100">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">
        <p>&copy; {{ now()->year }} Mercatia. All rights reserved.</p>

        <div class="flex gap-4">
            <a href="{{ route('terms') }}" class="hover:text-gray-900 transition">Terms & Conditions</a>
            <a href="{{ route('privacy') }}" class="hover:text-gray-900 transition">Privacy Policy</a>
            <a href="{{ url('/contact') }}" class="hover:text-gray-900 transition">Contact</a>
        </div>
    </div>
</footer>

   

    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.89/build/spline-viewer.js"></script>
    </div>

    <script>
        const loaderContainer = document.querySelector('.loader-container');
        const pageContent = document.querySelector('#page-content');

        window.addEventListener('load', () => {
            loaderContainer.classList.add('hidden');
            pageContent.classList.add('visible');
        })
    </script>
</body>
</html>
