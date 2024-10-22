<?php

use App\Models\Guest;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CartItemController;

// Route to get the authenticated user (via Sanctum)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('cart', CartController::class);
    Route::apiResource('cart-item', CartItemController::class);
});



Route::post('/set_cookie', function () {
    // $guestIdentifier = $request->cookie('guest_identifier');

    // if (!$guestIdentifier) {
        // Generate a new guest identifier
        $guestIdentifier = bin2hex(random_bytes(16));

        // Create the cookie directly

        $guest = Guest::firstOrCreate(['guest_identifier' => $guestIdentifier]);

        // Cookie::make('guest_id', $guestIdentifier, 60); // Store for 60 minutes

        // Set the cookie
        $cookie = Cookie::make('qe', 'fadfa', 60); // 60 minutes

        // Return a JSON response and attach the cookie
        return response()->json(['message' => 'Cookie set'])
            ->cookie($cookie);

        // Return the JSON response directly
        // return ['guest_identifier' => $guest->guest_identifier];
    // } else {
        // $guest = Guest::firstOrCreate(['guest_identifier' => $guestIdentifier]);
        // return ['guest_identifier' => $guest['guest_identifier']];
    // }
});
