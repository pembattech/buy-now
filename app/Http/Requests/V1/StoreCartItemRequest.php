<?php

namespace App\Http\Requests\V1;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCartItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cart_id' => 'required|exists:carts,id',
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1'
        ];
    }

    protected function prepareForValidation()
    {
        if (Auth::guard('sanctum')->check()) {
            $userId = auth('sanctum')->user()->id;
            $cart = Cart::firstOrCreate(['user_id' => $userId]);
        } else {
            $guestData = getGuest($this); // Get guest data including identifier and cookie
            $guest_id = $guestData['guest_identifier'];
            $cart = Cart::firstOrCreate(['guest_id' => $guest_id]);

            // Store the cookie in the class for later use
            $this->guestCookie = $guestData['cookie'];
        }

        $this->merge([
            'cart_id' => $cart->id,
            'product_id' => $this->productId,
        ]);
    }
}
