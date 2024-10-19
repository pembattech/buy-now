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

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $cart = Cart::firstOrCreate(['user_id' => $userId]);
        } else {
            $guest_id = getGuest($this);

            $cart = Cart::firstOrCreate(attributes: [
                'guest_id' => $guest_id['guest_identifier'],
            ]);
        }

        $this->merge([
            'cart_id' => $cart->id,
            'product_id' => $this->productId
        ]);
    }
}
