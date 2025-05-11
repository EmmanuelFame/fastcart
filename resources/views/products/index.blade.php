@extends('layouts.app')

@section('content')
<div class="px-4 py-8 mx-auto max-w-7xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Products</h1>
        <a href="{{ route('admin.products.create') }}"
            class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
            Add New Product
        </a>
    </div>

    @include('partials.messages')

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-sm text-left">
            <thead class="text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-6 py-4">Image</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Price</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-20 h-20 rounded-md shadow">
                        @else
                            <span class="italic text-gray-400">No image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->category->name ?? '—' }}</td>
                    <td class="px-6 py-4">N{{ number_format($product->price, 2) }}</td>
                    <td class="flex items-center justify-center px-6 py-4 space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}"
                            class="px-3 py-2 text-xs font-medium text-white bg-yellow-400 rounded-lg hover:bg-yellow-500">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                            onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-2 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="px-6 py-6 text-center text-gray-500" colspan="5">
                        No products found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection
