<x-app-layout>

    {{-- <div id="loading" class="text-center">Loading products...</div> --}}

    <div id="product-list" class="grid gap-4 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"></div>
    <div class="flex justify-center items-center my-6">
        <button type="button" id="load-more"
            class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Load
            More</button>
    </div>

    <script>
        window.onload = function() {
            loadProducts(1);
        };

        function loadProducts(page) {
            $.ajax({
                url: `/api/v1/products?page=${page}`,
                type: 'GET',
                success: function(response) {
                    response.data.forEach(function(product) {
                        const stockStatus = product.stock > 0 ?
                            '<span class="ring-4 ring-green-300 text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm p-2">In stock</span>' :
                            '<span class="ring-4 ring-red-300 text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm p-2">Out of stock</span>';

                        // Append product information
                        $('#product-list').append(`
                    <a href="/products/detail/${product.id}" class="product-item border p-4 hover:bg-gray-100 transition cursor-pointer" data-id="${product.id}">
                        <img src="${product.imageUrl}" alt="${product.name}">
                        <h3 class="font-bold text-lg">${truncateText(product.name, 30)}</h3>
                        <p class="font-thin text-gray-800">${truncateText(product.description, 100)}</p>
                        <p>Price: $${product.price}</p>
                        <p class="mt-4">${stockStatus}</p>
                    </a>
                `);
                    });

                    $('#load-more').show();

                    if (response.meta.current_page < response.meta.last_page) {
                        $('#load-more').data('page', response.meta.current_page + 1);
                    } else {
                        $('#load-more').hide();
                    }
                },
                error: function() {
                    alert('Failed to load products');
                }
            });
        }

        $('#load-more').click(function() {
            event.preventDefault();

            var nextPage = $(this).data('page');
            loadProducts(nextPage);
        });

        function truncateText(text, maxLength) {
            if (text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            } else {
                return text;
            }
        }
    </script>
</x-app-layout>
