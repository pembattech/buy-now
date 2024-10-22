<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V1\CartResource;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // TODO: Fix Admin can view all the cart instead of the below code!
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $cart = Cart::firstOrCreate(['user_id' => $userId]);
        } else {
            $guestIdentifier = $request->cookie('guest_identifier');

            if (!$guestIdentifier) {
                $guestData = getGuest($request);
                $guest_id = $guestData['guest_identifier'];
                $cart = Cart::firstOrCreate(['guest_id' => $guest_id]);
            } else {
                // Retrieve the cart for the existing guest
                $cart = Cart::where('guest_id', $guestIdentifier)->with('cartItems')->first();
            }
        }

        // If no cart is found (for guests), create a new one
        if (!isset($cart)) {
            $cart = Auth::check() ? Cart::firstOrCreate(['user_id' => $userId]) : Cart::firstOrCreate(['guest_id' => $guestIdentifier]);
        }

        $response = response()->json([
            'success' => true,
            'cart' => new CartResource($cart),
        ], 200);

        // If the user is a guest, attach the cookie to the response
        if (!Auth::check() && isset($guestData['cookie'])) {
            $response->withCookie($guestData['cookie']);
        }

        return $response;
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
            $cart = Cart::firstOrCreate(['guest_id' => $guest_id]);
        }

        // Prepare the JSON response
        $response = response()->json([
            'cart' => new CartResource($cart),
        ]);

        // If the user is a guest, attach the cookie to the response
        if (!Auth::check() && isset($guestData['cookie'])) {
            $response->withCookie($guestData['cookie']);
        }

        // Return the response
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $cartId)
    {
        try {
            $cart = Cart::findOrFail($cartId);

            if (Auth::check()) {
                $userId = Auth::user()->id;

                if ($cart->user_id !== $userId) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You do not have permission to view this cart.'
                    ], 403);
                }
            } else {
                $guestIdentifier = request()->cookie('guest_identifier');

                if (!$guestIdentifier) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No guest identifier found. Please ensure your session is active or try again.'
                    ], 400);
                }

                if ($cart->guest_id !== $guestIdentifier) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You do not have permission to view this cart.'
                    ], 403);
                }
            }

            return response()->json([
                'success' => true,
                'cart' => new CartResource($cart),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found.'
            ], 404);
        }
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

    public function destroy($id)
    {
        try {
            $cart = Cart::findOrFail($id);

            if (Auth::check()) {
                $userId = Auth::user()->id;

                if ($cart->user_id !== $userId) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You do not have permission to delete this cart.'
                    ], 403);
                }
            } else {
                $guestIdentifier = request()->cookie('guest_identifier');

                if (!$guestIdentifier) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No guest identifier found. Please ensure your session is active or try again.'
                    ], 400);
                }

                if ($cart->guest_id !== $guestIdentifier) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You do not have permission to delete this cart.'
                    ], 403);
                }
            }

            $cart->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cart successfully deleted.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found.'
            ], 404);
        }
    }
}
