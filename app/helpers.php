<?php

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Cart;

if (!function_exists('getGuest')) {
    function getGuest(Request $request)
    {
        $guestIdentifier = $request->cookie('guest_identifier');

        if (!$guestIdentifier) {
            // Generate a new guest identifier
            $guestIdentifier = bin2hex(random_bytes(16));

            // Return a response with the cookie
            $cookie = cookie('guest_identifier', $guestIdentifier, 60 * 24 * 7); // 1 week

            $guest = Guest::firstOrCreate(['guest_identifier' => $guestIdentifier]);

            // Return the guest object and the cookie
            return ['guest' => $guest, 'cookie' => $cookie];
        } else {
            $guest = Guest::firstOrCreate(['guest_identifier' => $guestIdentifier]);
            return ['guest_identifier' => $guest['guest_identifier']];
        }
    }
}
