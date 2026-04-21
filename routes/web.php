<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/services', [ProductController::class, 'index'])->name('services.index');
Route::get('/services/{product}', [ProductController::class, 'show'])->name('services.show');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{productId}', [CartController::class, 'remove'])->name('cart.remove');

    // Orders
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Reviews
    Route::post('/services/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // CLIENT dashboard
    Route::middleware('role:client,firm,admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'client'])->name('dashboard');
    });

    // FIRM routes
    Route::middleware('role:firm,admin')->prefix('firm')->name('firm.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'firm'])->name('dashboard');
        Route::get('/services/create', [ProductController::class, 'create'])->name('services.create');
        Route::post('/services', [ProductController::class, 'store'])->name('services.store');
        Route::get('/services/{product}/edit', [ProductController::class, 'edit'])->name('services.edit');
        Route::patch('/services/{product}', [ProductController::class, 'update'])->name('services.update');
        Route::delete('/services/{product}', [ProductController::class, 'destroy'])->name('services.destroy');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    });

    // ADMIN routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::patch('/users/{user}/role', function(\App\Models\User $user, \Illuminate\Http\Request $request) {
            $request->validate(['role' => 'required|in:client,firm,admin']);
            $user->update(['role' => $request->role]);
            return redirect()->back()->with('success', 'Role updated.');
        })->name('users.role');
        Route::delete('/users/{user}', function(\App\Models\User $user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted.');
        })->name('users.destroy');
    });
});
