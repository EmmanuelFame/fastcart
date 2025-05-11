<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage showing product listings
use App\Models\Category;

Route::get('/', function () {
    $categories = Category::with(['products.reviews'])->get();
    return view('welcome', compact('categories'));
})->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');




// Authentication routes (login, register, etc.)
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Orders
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/orders/{order}/status', [OrderStatusController::class, 'show'])->name('orders.status');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failed', [CheckoutController::class, 'failed'])->name('checkout.failed');
    Route::get('/payment/callback', [CheckoutController::class, 'handleCallback'])->name('payment.callback');
    Route::post('/checkout/pod', [App\Http\Controllers\CheckoutController::class, 'payOnDelivery'])->name('checkout.pod')->middleware('auth');


    //review
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

});

/*
|--------------------------------------------------------------------------
| Admin Routes (Products CRUD)
|--------------------------------------------------------------------------
*/
// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    
    Route::get('/orders', [OrderStatusController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/status', [OrderStatusController::class, 'show'])->name('orders.status');
    Route::post('/orders/{order}/status', [OrderStatusController::class, 'update'])->name('orders.status.update');
});

/*
|--------------------------------------------------------------------------
| Cart Routes (Accessible by all)
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

