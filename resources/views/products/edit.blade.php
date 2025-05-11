@extends('layouts.app')

@section('content')
<div class="max-w-3xl px-4 py-8 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">Edit Product</h1>

    @include('partials.messages')

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block mb-2 text-sm font-medium">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500">
        </div>

        <div>
            <label for="category_id" class="block mb-2 text-sm font-medium">Category</label>
            <select name="category_id" id="category_id" required
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500">
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-medium">Description</label>
            <textarea name="description" id="description" rows="4" required
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label for="price" class="block mb-2 text-sm font-medium">Price (N)</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}" required
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500">
        </div>

        <div>
            <label for="image" class="block mb-2 text-sm font-medium">Product Image</label>
            @if ($product->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="object-cover w-32 h-32 rounded-lg shadow-md">
                </div>
            @endif
            <input type="file" name="image" id="image"
                class="block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
        </div>

        <div class="flex items-center pt-4 space-x-4">
            <button type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                Update Product
            </button>
            <a href="{{ route('admin.products.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
