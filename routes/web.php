<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\User;
use App\Http\Controllers\ProductController;

// Rute login & registrasi
Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

// Rute profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute dashboard berdasarkan role
Route::middleware(['auth', 'role.access'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    })->name('dashboard');
});

// Rute untuk admin
Route::prefix('admin')->middleware(['auth', 'role.access:admin'])->group(function () {
    Route::get('/dashboard', [Admin::class, 'index'])->name('admin.dashboard');
    Route::resource('products', CrudController::class);
});

// Rute untuk user
Route::middleware(['auth', 'role.access:user'])->group(function () {
    Route::get('/user/dashboard', [User::class, 'index'])->name('user.dashboard');
});

// Rute produk
Route::prefix('products')->middleware(['auth', 'role.access:admin'])->group(function () {
    Route::get('/', [CrudController::class, 'index'])->name('products.index');
    Route::get('/{product}/edit', [CrudController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [CrudController::class, 'update'])->name('products.update');
    Route::get('/{id}', [CrudController::class, 'show'])->name('products.show');
});

// Rute keranjang
Route::prefix('cart')->middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
});

// resources/routes/web.php

Route::middleware('auth')->group(function () {

    // Cek peran pengguna untuk akses cart
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index')
        ->middleware('role:user'); // Pastikan hanya pengguna dengan role 'user' yang bisa mengakses cart

    Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add')
        ->middleware('role:user'); // Hanya user yang bisa menambah produk ke cart

    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove')
        ->middleware('role:user'); // Hanya user yang bisa menghapus produk dari cart

    // Checkout hanya untuk user, bukan admin
    Route::get('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')
        ->middleware('role:user');

    Route::post('cart/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout')
        ->middleware('role:user');
});

// routes/web.php



Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
