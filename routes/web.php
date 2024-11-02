<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return view('products.index');
})->name('products.index');

Route::get('/products/detail/{product}', function () {
    return view('products.product_detail');
})->name('products.detail');

Route::get('/cart', function () {
    return view('carts.index');
})->name('carts.index');

Route::get('/cart/clear', function () {
    return view('carts.delete');
})->name('carts.delete');

// Route::get('/login', function () {
//     if (auth('sanctum')->check()) {
//         return redirect()->route('products.index'); // Add `return` to ensure the redirect is executed
//     }
//     return view('auth.login'); // Load the login page if the user is not authenticated
// })->name('login');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
