<?php

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\Guest;

if (!function_exists('getGuest')) {
    function getGuest(Request $request)
    {
        // Check if the guest identifier cookie exists
        $guestIdentifier = $request->cookie('guest_identifier');

        if (!$guestIdentifier) {
            // Generate a new guest identifier
            $guestIdentifier = bin2hex(random_bytes(16));

            // Create a new guest record in the database
            Guest::firstOrCreate(['guest_identifier' => $guestIdentifier]);

            // Create a cookie to store the guest identifier for 60 minutes
            $cookie = Cookie::make(name: 'guest_identifier', value: $guestIdentifier, minutes: 60);
        } else {
            // If the cookie already exists, ensure a guest record is created
            Guest::firstOrCreate(['guest_identifier' => $guestIdentifier]);

            // Use the cookie that already exists
            $cookie = Cookie::make('guest_identifier', $guestIdentifier, 60); // Optional: Refresh the cookie expiration
        }

        // Return the guest identifier and the cookie
        return ['guest_identifier' => $guestIdentifier, 'cookie' => $cookie];
    }
}