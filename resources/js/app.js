import './bootstrap';

// Set up CSRF token for all Ajax requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.onload = function () {
    loadProducts(1);
    fetchCartItemNum()
};

function loadProducts(page) {
    $.ajax({
        url: `/api/v1/products?page=${page}`,
        type: 'GET',
        success: function (response) {
            response.data.forEach(function (product) {
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
        error: function () {
            alert('Failed to load products');
        }
    });
}

$('#load-more').click(function (e) {
    e.preventDefault();

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

function fetchCartItemNum() {
    $.ajax({
        url: `/api/v1/cart/`,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const cartItems = response.cart.items;
            const itemsLength = cartItems.length;

            if (itemsLength > 0) {
                $('#cart-item-num').text(itemsLength);
                $('#cart-item-num').removeClass('hidden');
            } else {
                $('#cart-item-num').addClass('hidden');
            }
        }
    });
}

// product detail
if (window.location.href.includes('/products/detail/')) {
    console.log('true')
    productDetail();
}

function productDetail() {
    const productId = window.location.pathname.split('/').pop();

    $.ajax({
        url: `/api/v1/products/${productId}`,
        type: 'GET',
        success: function (response) {
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
        error: function () {
            alert('Failed to fetch product details');
        }
    });
}

$('#increment').click(function (e) {
    e.preventDefault();
    var currentVal = parseInt($('#quantity-input').val());
    $('#quantity-input').val(currentVal + 1);
});

$('#decrement').click(function (e) {
    e.preventDefault();
    var currentVal = parseInt($('#quantity-input').val());
    if (currentVal > 1) {
        $('#quantity-input').val(currentVal - 1);
    }
});

$('#addtocart').submit(function (e) {
    e.preventDefault();

    var quantity = $('#quantity-input').val();
    const productId = window.location.pathname.split('/').pop();

    $.ajax({
        url: '/api/v1/cart-item',
        type: 'POST',
        data: {
            quantity: quantity,
            productId: productId
        },
        dataType: 'json',
        success: function (response) {
            $('#addtocart')[0].reset();

            fetchCartItemNum()

            alert(response.message);
        },
        error: function (xhr, status, error) {
            alert('Failed to add product to cart.');
        }
    });
});

// cart
if (window.location.href.includes('/cart')) {
    fetchDefaultCart();
}

function fetchDefaultCart() {
    localStorage.removeItem('id');

    $.ajax({
        url: `/api/v1/cart/`,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const cartItems = response.cart;
            console.log(cartItems);

            localStorage.setItem('id', cartItems.id);

            if (cartItems && cartItems.items.length > 0) {
                displayCartItems(cartItems.items);
            } else {
                $('#cart-items').html('<p>Your cart is empty.</p>');
            }
        },
        error: function () {
            $('#cart-items').html('<p>Failed to load cart items.</p>');
        }
    });
}

// function fetchCartItems(cartId) {
//     $.ajax({
//         url: `/api/v1/cart/${cartId}`,
//         type: 'GET',
//         success: function (response) {
//             const cartItems = response.cart;
//             console.log(cartItems);

//             if (cartItems && cartItems.items.length > 0) {
//                 displayCartItems(cartItems.items);
//             } else {
//                 $('#cart-items').html('<p>Your cart is empty.</p>');
//             }
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             $('#cart-items').html('<p>Failed to load cart items.</p>');
//         }
//     });
// }

function displayCartItems(items) {
    console.log(items)
    let cartHtml = `
            <div class="flex gap-8">
                <div>
                    <ul>
            `;

    items.forEach(function (item) {
        cartHtml += `
                <li class="mb-4">
                    <div class="flex gap-4">
                        <img src="${item.product.imageUrl}" alt="${item.product.name}" class="w-20 h-20 object-cover" />
                        <div>
                            <p class="font-semibold">${item.product.name}</p>
                            <p class="font-thin text-gray-800">${truncateText(item.product.description, 80)}</p>
                            <div class="-ml-1 clear-cart-item" data-product-id="${item.product.id}">
                                <p>hdfl</p>
                            </div>

                        </div>
                        <div class="flex items-center gap-4">
                            <div>
                                <p>Quantity: ${item.quantity}</p>
                                <p class="font-semibold">$${item.product.price}</p>
                            </div>
                            <p class="text-red-700 font-bold text-2xl">$${item.price}</p>
                        </div>
                    </div>
                </li>
            `;
    });

    cartHtml += `
            </ul>
        </div>
        `;

    const subtotal = items.reduce((acc, item) => acc + item.price, 0); // Calculate subtotal dynamically
    const shipping = 5.00;
    const tax = subtotal * 0.05;
    const total = subtotal + shipping + tax;

    cartHtml += `
            <div class="order-summary p-6 bg-white shadow-md rounded-lg flex-1 sticky top-1/3 h-full overflow-auto">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="flex justify-between mt-4 font-bold">
                    <p>Subtotal:</p>
                    <p>$${subtotal.toFixed(2)}</p>
                </div>
                <div class="flex justify-between mt-2 font-bold">
                    <p>Shipping:</p>
                    <p>$${shipping.toFixed(2)}</p>
                </div>
                <div class="flex justify-between mt-2 font-bold">
                    <p>Tax:</p>
                    <p>$${tax.toFixed(2)}</p>
                </div>
                <div class="flex justify-between mt-4 text-lg">
                    <p>Total:</p>
                    <p class="text-green-600">$${total.toFixed(2)}</p>
                </div>
                <button class="mt-4 w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Proceed to Checkout</button>
            </div>
        `;

    $('#cart-items').html(cartHtml);
}

// cart delete
$('#clear-cart').click(function () {
    if (confirm('Are you sure you want to clear your cart?')) {
        let cartId = localStorage.getItem('id');
        clearCart(cartId);
    }

});

$(document).on('click', '.clear-cart-item', function () {
    let productId = $(this).data('product-id');
    console.log(productId);
    clearCartItem(productId);
});

function clearCart(cartId) {
    $.ajax({
        url: `/api/v1/cart/${cartId}`,
        type: 'DELETE',
        success: function (response) {

            $('#cart-item-num').addClass('hidden');

            console.log(response)
            const cartItems = response.cart;

            if (cartItems && cartItems.items.length > 0) {
                displayCartItems(cartItems.items);
            } else {
                $('#cart-items').html('<p>Your cart is empty.</p>');
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error clearing cart:', textStatus, errorThrown);
        }
    });
}

function clearCartItem(productId) {
    $.ajax({
        url: `/api/v1/cart-item/${productId}`,
        type: 'DELETE',
        success: function (response) {

            fetchDefaultCart();
            fetchCartItemNum();

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error clearing cart:', textStatus, errorThrown);
        }
    });
}
