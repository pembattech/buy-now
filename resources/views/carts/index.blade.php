<x-app-layout>
    <div id="cart-items" class="my-6">
        <!-- Cart items will be displayed here -->
    </div>

    <script>
        $(document).ready(function() {
            const cartId = 4;

            $.ajax({
                url: `/api/v1/cart/${cartId}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    
                    const cartItems = response.data;
                    console.log(cartItems);

                    if (cartItems.length === 0) {
                        $('#cart-items').html('<p>Your cart is empty.</p>');
                    } else {
                        let cartHtml = '<ul>';
                        cartItems.items.forEach(function(item) {
                            cartHtml += `
                                <li class="mb-4">
                                    <div class="flex items-center gap-4">
                                        <img src="${item.product.imageUrl}" alt="${item.product.name}" class="w-16 h-16 object-cover" />
                                        <div>
                                            <p class="font-semibold">${item.product.name}</p>
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
                },
                error: function() {
                    $('#cart-items').html('<p>Failed to load cart items.</p>');
                }
            });
        });
    </script>
</x-app-layout>
