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
            // User is authenticated
            $userId = Auth::user()->id;

            // Create or retrieve the cart for the authenticated user
            $cart = Cart::firstOrCreate(['user_id' => $userId]);
        } else {
            // User is a guest
            $guestData = getGuest($request); // Get guest data including identifier and cookie

            // Access the guest identifier
            $guest_id = $guestData['guest_identifier'];

            // Create or retrieve the cart for the guest
            $cart = Cart::fir2stOrCreate(['guest_id' => $guest_id]);
        }

        // Prepare the JSON response
        $response = response()->json(['cart' => $cart]);

        // If the user is a guest, attach the cookie to the response
        if (!Auth::check()) {
            $response->withCookie($guestData['cookie']);
        }

        // Return the response
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
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
