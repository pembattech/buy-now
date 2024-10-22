<x-app-layout>

    <div id="product-details" class="flex gap-4">
        <div>
            <img id="product-image" class="hidden w-64 h-64 object-cover mb-4" alt="Product Image">
        </div>

        <div>

            <h1 id="product-name" class="text-2xl font-bold mb-2"></h1>
            <p id="product-description" class="text-gray-600 mb-2"></p>

            <div class="flex items-center gap-2 my-4">
                <p id="product-price" class="text-xl font-semibold"></p>
                <p id="product-stock" class="text-sm"></p>
            </div>

            <form action="#" id="addtocart">
                <div class="inline-flex items-center">
                    <span class="bg-gray-300 text-gray-700 px-3 py-2 rounded-l">Quantity</span>
                    <button class="bg-gray-200 text-gray-600 px-3 py-2 hover:bg-gray-300" id="decrement">-</button>
                    <input type="number" value="1" min="1" id="quantity-input"
                        class="w-16 text-center border-t border-b border-gray-300 py-2 focus:outline-none" />
                    <button class="bg-gray-200 text-gray-600 px-3 py-2 hover:bg-gray-300" id="increment">+</button>
                </div>

                <div class="add-to-cart-btn hidden my-6">
                    <button type="submit"
                        class="cursor-default w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                        Add to cart
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const productId = window.location.pathname.split('/').pop();

            $.ajax({
                url: `/api/v1/products/${productId}`,
                type: 'GET',
                success: function(response) {
                    const product = response.data;

                    $('#product-image').attr('src', product.imageUrl).show();

                    $('#product-name').text(product.name);
                    $('#product-description').text(product.description);
                    $('#product-price').text(`Price: $${product.price}`);

                    $('.add-to-cart-btn').show();

                    if (product.stock > 0) {
                        $('#product-stock').html(
                            '<span class="ring-4 ring-green-300 text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm p-2">In stock</span>'
                        );

                    } else {
                        $('#product-stock').html(
                            '<span class="ring-4 ring-red-300 text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm p-2">Out of stock</span>'
                        );

                        $('.add-to-cart-btn').hide();
                    }
                },
                error: function() {
                    alert('Failed to fetch product details');
                }
            });

            $('#increment').click(function(e) {
                e.preventDefault();
                var currentVal = parseInt($('#quantity-input').val());
                $('#quantity-input').val(currentVal + 1);
            });

            $('#decrement').click(function(e) {
                e.preventDefault();
                var currentVal = parseInt($('#quantity-input').val());
                if (currentVal > 1) {
                    $('#quantity-input').val(currentVal - 1);
                }
            });

            // Set up CSRF token for all Ajax requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#addtocart').submit(function(e) {
                e.preventDefault();

                var quantity = $('#quantity-input').val();

                console.log(quantity, productId);

                $.ajax({
                    url: '/api/v1/cart-item',
                    type: 'POST',
                    data: {
                        quantity: quantity,
                        productId: productId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#addtocart')[0].reset();
                        alert(response.message);

                    },
                    error: function(xhr, status, error) {
                        alert('Failed to add product to cart.');
                    }
                });
            });
        });
    </script>

</x-app-layout>
