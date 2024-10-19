<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V1\CartResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $cart = Cart::firstOrCreate([
                'user_id' => $userId,
            ]);
        } else {
            $guest_id = getGuest($request);

            $cart = Cart::firstOrCreate(attributes: [
                'guest_id' => $guest_id['guest_identifier'],
            ]);
        }

        return response()->json(['cart'=> $cart]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        // return 'dfa';
        return new CartResource($cart);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
