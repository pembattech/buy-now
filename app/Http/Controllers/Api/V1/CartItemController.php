<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
    public function store(StoreCartItemRequest $request)
    {
        // Find the product
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $cartItem = CartItem::where('cart_id', $request->cart_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Update existing cart item quantity and price
            $new_quantity = $cartItem->quantity + $request->quantity;
            $new_price = $new_quantity * $product->price;

            $cartItem->update(['quantity' => $new_quantity, 'price' => $new_price]);
            $message = "{$product->name} has been updated in your cart.";
        } else {
            // Add new cart item
            $cartItem = CartItem::create([
                'cart_id' => $request->cart_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price * $request->quantity,
            ]);
            $message = "{$product->name} has been added to your cart.";
        }

        // Sum up the total price of all items in the cart
        $totalPrice = CartItem::where('cart_id', $request->cart_id)->sum('price');

        // Update the total price in the cart
        Cart::where('id', $request->cart_id)->update(['total_price' => $totalPrice]);

        // Prepare the response
        $response = response()->json([
            'success' => true,
            'message' => $message,
            'cart_id' => $request->cart_id, // Return the cart ID if needed
        ]);

        // Attach the guest cookie if it exists
        if (property_exists($request, 'guestCookie')) {
            $response->withCookie($request->guestCookie);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartItemRequest $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified cart item using product_id.
     */
    public function destroy(Request $request, $productId)
    {
        if (Auth::check()) {
            // User is authenticated, get the user_id
            $userId = Auth::user()->id;

            $cartItem = CartItem::where('product_id', $productId)
                ->whereHas('cart', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->first();
        } else {
            $guestIdentifier = $request->cookie('guest_identifier');

            if (!$guestIdentifier) {
                return response()->json([
                    'success' => false,
                    'message' => 'Guest identifier not found.'
                ], 400);
            }

            $cartItem = CartItem::where('product_id', $productId)
                ->whereHas('cart', function ($query) use ($guestIdentifier) {
                    $query->where('guest_id', $guestIdentifier);
                })
                ->first();
        }

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in the cart.'
            ], 404);
        }

        $cartItem->delete();

        // update the total price in the cart after deletion
        $totalPrice = CartItem::where('cart_id', $cartItem->cart_id)->sum('price');
        Cart::where('id', $cartItem->cart_id)->update(['total_price' => $totalPrice]);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully.',
            'total_price' => $totalPrice
        ]);
    }
}
