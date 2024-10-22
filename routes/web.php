<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/products/detail/{product}', function () {
    return view('products.product_detail');
})->name('products.detail');

Route::get('/cart', function () {
    return view('carts.index');
})->name('carts.index');


// Route::redirect('/','/api/v1/products');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
