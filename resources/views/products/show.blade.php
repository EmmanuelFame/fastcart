@extends('layouts.app')

@section('content')

<div class="max-w-6xl px-4 py-8 mx-auto">
    <!-- Product Display -->
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
        <div>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                     class="object-cover w-full h-[28rem] rounded-lg shadow-lg">
            @endif
        </div>

        <div>
            <h1 class="mb-4 text-4xl font-bold">{{ $product->name }}</h1>
            <p class="mb-2 text-gray-600">Category: {{ $product->category->name ?? '—' }}</p>
            <p class="mb-4 text-2xl font-semibold text-green-700">N{{ number_format($product->price, 2) }}</p>
            <p class="mb-6">{{ $product->description }}</p>
            @if($product->reviews->count())
    <div class="mb-4">
        <h2 class="mb-2 text-xl font-semibold">Average Rating</h2>
        <p class="text-yellow-500">
            {!! str_repeat('⭐', round($product->average_rating)) !!}
            <span class="ml-2 text-sm text-gray-600">
                ({{ number_format($product->average_rating, 1) }}/5 from {{ $product->reviews->count() }} reviews)
            </span>
        </p>
    </div>

    <div class="mt-6">
        <h3 class="mb-2 text-lg font-semibold">Customer Reviews</h3>
        @foreach ($product->reviews as $review)
            <div class="p-4 mb-3 bg-gray-100 rounded dark:bg-gray-700">
                <div class="flex items-center justify-between mb-1">
                    <strong>{{ $review->user->name }}</strong>
                    <span class="text-yellow-500">{!! str_repeat('⭐', $review->rating) !!}</span>
                </div>
                <p class="text-sm text-gray-700 dark:text-gray-200">{{ $review->comment }}</p>
            </div>
        @endforeach
    </div>
@endif

            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="space-y-4">
    @csrf

    <!-- Quantity Selector -->
    <div class="flex items-center gap-3">
        <label for="quantity" class="text-sm font-medium">Quantity:</label>
        <div class="flex items-center border rounded-md w-28">
            <button type="button" class="w-8 h-8 text-xl text-gray-600 hover:text-black"
                    onclick="changeQuantity(-1)">−</button>
            <input type="number" name="quantity" id="quantity" value="1" min="1"
                   class="w-12 text-center border-none focus:outline-none" />
            <button type="button" class="w-8 h-8 text-xl text-gray-600 hover:text-black"
                    onclick="changeQuantity(1)">+</button>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4 mt-4">
        <button type="submit"
                class="px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            Add to Cart
        </button>
        <a href="{{ route('cart.index') }}"
           class="inline-flex items-center px-6 py-3 text-white bg-green-600 rounded-lg hover:bg-green-700">
            Go to Cart
        </a>
    </div>
</form>



        </div>
    </div>

 @if ($hasPurchased)
    <form method="POST" action="{{ route('reviews.store', ['product' => $product->id]) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-6">
        @csrf

        <h3 class="text-lg font-semibold mb-4">Leave a Review</h3>

        <div class="mb-4">
            <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
            <select name="rating" id="rating" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ isset($review) && $review->rating == $i ? 'selected' : '' }}>
                        {{ $i }} {{ str_repeat('⭐', $i) }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="mb-4">
            <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
            <textarea name="comment" id="comment" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $review->comment ?? '' }}</textarea>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ $review ? 'Update Review' : 'Submit Review' }}
            </button>
        </div>
    </form>
@endif



<!-- Related Products Carousel -->
@if($relatedProducts->count())
<div class="relative mt-16 max-w-7xl mx-auto px-4">
    <h2 class="mb-6 text-2xl font-bold">You may also like</h2>

    <div class="relative">
        <div class="flex overflow-x-auto scrollbar-hide space-x-4 scroll-smooth" id="relatedScroll">
            @foreach($relatedProducts as $related)
                <div class="w-56 flex-shrink-0">
                    <a href="{{ route('products.show', $related) }}"
                       class="block h-full p-4 bg-white rounded-lg shadow hover:shadow-lg">
                        @if ($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}"
                                 alt="{{ $related->name }}"
                                 class="object-cover w-full h-32 mb-3 rounded">
                        @endif
                        <h3 class="text-base font-semibold">{{ $related->name }}</h3>
                        <p class="text-sm text-gray-600">N{{ number_format($related->price, 2) }}</p>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Left/Right buttons with IDs instead of onclick -->
        <button id="scrollLeftBtn"
            class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 p-2 bg-white rounded-full shadow-md hover:bg-gray-100">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="scrollRightBtn"
            class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 p-2 bg-white rounded-full shadow-md hover:bg-gray-100">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>
@endif

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>


@endsection

@push('scripts')
<script>


function changeQuantity(delta) {
        const qtyInput = document.getElementById('quantity');
        let current = parseInt(qtyInput.value) || 1;
        current += delta;
        if (current < 1) current = 1;
        qtyInput.value = current;
    }

function scrollRelated(direction) {
    const container = document.getElementById('relatedScroll');
    const scrollAmount = 400;
    container.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}

window.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('relatedScroll');
    let autoScrollId;
    let scrollSpeed = 0.5; // pixels per frame (adjust as needed)

    function autoScrollLoop() {
        const maxScroll = container.scrollWidth - container.clientWidth;
        container.scrollLeft += scrollSpeed;

        if (container.scrollLeft >= maxScroll) {
            container.scrollLeft = 0; // loop back to start
        }

        autoScrollId = requestAnimationFrame(autoScrollLoop);
    }

    function startAutoScroll() {
        autoScrollId = requestAnimationFrame(autoScrollLoop);
    }

    function stopAutoScroll() {
        cancelAnimationFrame(autoScrollId);
    }

    // Pause auto-scroll on hover (desktop)
    container.addEventListener('mouseenter', stopAutoScroll);
    container.addEventListener('mouseleave', startAutoScroll);

    // Pause auto-scroll on touch (mobile)
    container.addEventListener('touchstart', stopAutoScroll, { passive: true });
    container.addEventListener('touchend', startAutoScroll);

    startAutoScroll();
});
</script>
@endpush


