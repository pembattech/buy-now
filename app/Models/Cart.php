<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'guest_id',
        'user_id',
        'total_price'
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
