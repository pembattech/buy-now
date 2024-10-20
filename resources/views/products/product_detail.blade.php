<x-app-layout>

    <div id="product-details" class="flex gap-4">
        <div>
            <img id="product-image" class="hidden w-64 h-64 object-cover mb-4" alt="Product Image">
        </div>

        <div>

            <h1 id="product-name" class="text-2xl font-bold mb-2"></h1>
            <p id="product-description" class="text-gray-600 mb-2"></p>

            <div class="flex items-center gap-2">
                <p id="product-price" class="text-xl font-semibold"></p>
                <p id="product-stock" class="text-sm"></p>
            </div>

            <div class="add-to-cart hidden my-6">
                <p
                    class="active:ring-4 active:ring-blue-300 cursor-default w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                    Add to cart</p>
            </div>
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
                    console.log(product)

                    $('#product-name').text(product.name);
                    $('#product-description').text(product.description);
                    $('#product-price').text(`Price: $${product.price}`);

                    $('.add-to-cart').show();

                    if (product.stock > 0) {
                        $('#product-stock').html(
                            '<span class="ring-4 ring-green-300 text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm p-2">In stock</span>'
                            );
                            
                        } else {
                            $('#product-stock').html(
                                '<span class="ring-4 ring-red-300 text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm p-2">Out of stock</span>'
                            );

                            $('.add-to-cart').hide();
                    }
                    $('#product-image').attr('src', product.imageUrl).show();

                },
                error: function() {
                    alert('Failed to fetch product details');
                }
            });
        });
    </script>

</x-app-layout>
