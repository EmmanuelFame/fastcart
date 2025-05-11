<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Section: Logo and Links -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}">
                    <x-application-logo class="w-auto text-gray-800 fill-current h-9" />
                </a>

                <div class="hidden space-x-6 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link :href="route('profile.orders')" :active="request()->routeIs('profile.orders')">
                            {{ __('My Orders') }}
                        </x-nav-link>

                        @if(Auth::user()->role === 'admin' ?? false)
                            <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('products.*')">
                                {{ __('Products') }}
                            </x-nav-link>
                        @endif
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Section: Cart and User Dropdown -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                    Cart
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-600 rounded-full -top-1 -right-1">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                                {{ Auth::user()->name }}
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5.25 7.75L10 12.5l4.75-4.75" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke="currentColor" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke="currentColor" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.orders')" :active="request()->routeIs('profile.orders')">
                    {{ __('My Orders') }}
                </x-responsive-nav-link>

                @if(Auth::user()->role === 'admin' ?? false)
                    <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('products.*')">
                        {{ __('Products') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Mobile User Dropdown -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin Dashboard') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
