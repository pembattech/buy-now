<x-app-layout>
    <div id="cart-items">
        <!-- Cart items will be displayed here -->
    </div>

    {{-- <script>
        $(document).ready(function() {
            fetchDefaultCart();

            function fetchDefaultCart() {
                $.ajax({
                    url: `/api/v1/cart/`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const cartItems = response.cart;
                        console.log(cartItems);

                        if (cartItems && cartItems.items.length > 0) {
                            displayCartItems(cartItems.items);
                        } else {
                            $('#cart-items').html('<p>Your default cart is empty.</p>');
                        }
                    },
                    error: function() {
                        $('#cart-items').html('<p>Failed to load default cart.</p>');
                    }
                });
            }

            function fetchCartItems(cartId) {
                $.ajax({
                    url: `/api/v1/cart/${cartId}`,
                    type: 'GET',
                    success: function(response) {
                        const cartItems = response.cart;
                        console.log(cartItems);

                        if (cartItems && cartItems.items.length > 0) {
                            displayCartItems(cartItems.items);
                        } else {
                            $('#cart-items').html('<p>Your cart is empty.</p>');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#cart-items').html('<p>Failed to load cart items.</p>');
                    }
                });
            }

            function displayCartItems(items) {
                let cartHtml = '<ul>';
                items.forEach(function(item) {
                    cartHtml += `
                        <li class="mb-4">
                            <div class="flex items-center gap-4">
                                <img src="${item.product.imageUrl}" alt="${item.product.name}" class="w-16 h-16 object-cover" />
                                <div>
                                    <p class="font-semibold">${item.product.name}</p>
                                    <p class="font-thin text-gray-800">${truncateText(item.product.description, 100)}</p>
                                    <p>Quantity: ${item.quantity}</p>
                                    <p>Price: $${item.product.price}</p>
                                </div>
                            </div>
                        </li>
                    `;
                });
                cartHtml += '</ul>';
                $('#cart-items').html(cartHtml);
            }
        });
    </script> --}}
</x-app-layout>
