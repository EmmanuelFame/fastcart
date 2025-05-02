<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 





class ProductController extends Controller
{

    /**
     * Display a listing of the resource (Product List).
     */
    public function index()
    {
        $products = Product::latest()->paginate(10); // You can change 10 to any number
        return view('products.index', compact('products'));
    }

       
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // updated here
        ]);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public'); 
            $validated['image'] = $path;
        }
    
        Product::create($validated);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);
    
        // If there's a new image uploaded
        if ($request->hasFile('image')) {
            // Optionally delete the old image
            if ($product->image) {
                Storage::delete($product->image); // Assuming you store image paths
            }
    
            // Store new image
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }
    
        $product->update($validated);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    
}
