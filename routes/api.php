<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CartItemController;
use App\Models\User;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/user', function (Request $request) {
    if (Auth::guard('sanctum')->check()) {
        return auth('sanctum')->user()->id;
    } else {
        return false;
    }
});

Route::get('user-info/{user_id}', function ($user_id) {
    if (Auth::guard('sanctum')->check()) {
        $userId = auth('sanctum')->user()->id;
        if ($userId == $user_id) {

            return User::find($user_id);
        } else {
            return [$userId, $user_id];
        }

    }
});

// Versioned API Routes (v1)
Route::group(['prefix' => 'v1'], function () {

    Route::apiResource('products', ProductController::class);
    Route::apiResource('cart', CartController::class);
    Route::apiResource('cart-item', CartItemController::class);

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
