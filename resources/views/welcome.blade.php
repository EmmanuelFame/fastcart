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
    #hero {
        min-height: 100vh;
        position: relative;
        color: white;
        overflow: hidden;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center; /* Center horizontally */
        padding: 0 1rem;
        text-align: center;
    }

    header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 30;
        background: rgba(0, 0, 0, 0.6);
    }
</style>



<body class="flex flex-col min-h-screen text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-gray-100">

    <div class="loader-container">
        <div class="loader"></div>
    </div>

    <div id="page-content">

        <!-- Hero Section -->
<section id="hero">
    <!-- Background Video -->
    <video muted loop autoplay playsinline>
        <source src="{{ asset('videos/Video-2@C.webm') }}" type="video/webm">
    </video>

    <!-- Content Layer -->
    <div class="hero-content">

        <!-- Fixed Header -->
        <header>
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/" class="text-xl font-bold sm:text-2xl whitespace-nowrap">Fastcart</a>

                <!-- Mobile toggle button -->
                <button data-collapse-toggle="navbar-default" type="button"
                        class="inline-flex items-center p-2 ml-3 text-sm text-white rounded-lg md:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600"
                        aria-controls="navbar-default" aria-expanded="false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Nav Links -->
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-6 md:mt-0 text-sm sm:text-base">
                        @auth
                            <li><a href="{{ url('/dashboard') }}" class="block py-2 pl-3 pr-4 hover:underline">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="block py-2 pl-3 pr-4 hover:underline">Log in</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}" class="block py-2 pl-3 pr-4 hover:underline">Register</a></li>
                            @endif
                        @endauth
                        <li>
                            <a href="{{ route('cart.index') }}"
                               class="relative inline-flex items-center px-3 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-300 text-xs sm:text-sm">
                                Cart
                                @if($cartCount > 0)
                                    <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 sm:w-5 sm:h-5 text-[10px] sm:text-xs font-bold text-white transform translate-x-2 -translate-y-2 bg-red-600 rounded-full">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Hero Text -->
        <div class="px-6 mx-auto text-center max-w-7xl mt-24 sm:mt-32">
            <h3 class="mb-4 text-3xl sm:text-4xl font-bold">Welcome to Fastcart</h3>
            <h2 class="mb-4 text-2xl sm:text-4xl font-bold">A Milestar Trade and Export Limited Project</h2>
            <p class="mb-6 text-base sm:text-lg">Discover amazing products at unbeatable prices!</p>
            <a href="#products"
               class="px-6 py-3 font-semibold text-green-600 transition bg-white rounded-full hover:bg-gray-100">
                Shop Now
            </a>
            <p class="mt-4 text-sm text-gray-300">
                *All items displayed are for demonstration purposes only and are not available for purchase.*
            </p>
        </div>

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

   
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.querySelector('[data-collapse-toggle]');
        const navMenu = document.getElementById(toggleBtn.getAttribute('data-collapse-toggle'));

        toggleBtn.addEventListener('click', function () {
            navMenu.classList.toggle('hidden');
        });
    });
</script>

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
