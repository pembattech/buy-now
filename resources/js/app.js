import './bootstrap';

window.onload = function () {
    loadProducts(1);
    fetchCartItemNum()
};


// Set up CSRF token for all Ajax requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


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

function fetchUserInfo(userId) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `api/user-info/${userId}`,
            type: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
            },
            success: function (response) {
                if (response.id) {
                    resolve(response);
                } else {
                    reject('Access denied or user not found.');
                }
            },
            error: function (error) {
                reject(error);
            }
        });
    });
}


function fetchUserId(token) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/api/user',
            type: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
            },
            success: function (response) {
                if (response !== false) {
                    resolve(true);
                } else {
                    resolve(false);
                }
            },
            error: function (error) {
                console.log("An error occurred:", error);
                resolve(false);
            }
        });
    });
}

function fetchCartItemNum() {
    const token = localStorage.getItem('auth_token');

    const updateCartDisplay = (cartItems) => {
        const itemsLength = cartItems.length;
        if (itemsLength > 0) {
            $('#cart-item-num').text(itemsLength).removeClass('hidden');
        } else {
            $('#cart-item-num').addClass('hidden');
        }
    };

    const updateAuthDisplay = (userName) => {
        if (userName) {
            $('#auth').html(`
                <span>Welcome, ${userName}</span>
                <button id="logout" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Logout</button>
            `);
        } else {
            $('#auth').html(`<a href="/login" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Login</a>`);
        }
    };

    const fetchCart = (headers = {}) => {
        $.ajax({
            url: `/api/v1/cart/`,
            type: 'GET',
            headers: headers,
            dataType: 'json',
            success: function (response) {
                const cartItems = response.cart.items;
                updateCartDisplay(cartItems);

                const userId = response.cart.userId;
                if (userId) {
                    fetchUserInfo(userId)
                        .then(user => {
                            updateAuthDisplay(user.name);
                        })
                        .catch(error => console.error('Error fetching user info:', error));
                } else {
                    updateAuthDisplay(null);
                }
            },
            error: function (error) {
                console.error("An error occurred while fetching cart items:", error);
            }
        });
    };

    if (token) {
        fetchUserId(token)
            .then(isAuthenticated => {
                const headers = isAuthenticated ? { 'Authorization': `Bearer ${token}` } : {};
                fetchCart(headers);
            })
            .catch(error => console.error("An error occurred in authentication check:", error));
    } else {
        fetchCart();
    }
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

    const token = localStorage.getItem('auth_token');

    const ifTrue = token && fetchUserId(token);

    const headers = {};

    if (ifTrue) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    $.ajax({
        url: '/api/v1/cart-item',
        type: 'POST',
        headers: headers,
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
    const token = localStorage.getItem('auth_token');

    if (token) {
        fetchUserId(token).then(isAuthenticated => {

            const headers = {};

            if (isAuthenticated) {
                headers['Authorization'] = `Bearer ${token}`;
            }

            $.ajax({
                url: `/api/v1/cart/`,
                type: 'GET',
                headers: headers,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    const cartItems = response.cart.items;
                    const itemsLength = cartItems.length;

                    if (itemsLength > 0) {
                        $('#cart-item-num').text(itemsLength);
                        $('#cart-item-num').removeClass('hidden');

                        displayCartItems(cartItems);

                    } else {
                        $('#cart-item-num').addClass('hidden');

                        $('#cart-items').html('<p>Your cart is empty.</p>');
                    }
                },
                error: function (error) {
                    console.log("An error occurred while fetching cart items:", error);
                }
            });
        }).catch(error => {
            console.log("An error occurred in authentication check:", error);
        });
    } else {
        $.ajax({
            url: `/api/v1/cart/`,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                const cartItems = response.cart.items;
                const itemsLength = cartItems.length;

                if (itemsLength > 0) {
                    $('#cart-item-num').text(itemsLength);
                    $('#cart-item-num').removeClass('hidden');

                    displayCartItems(cartItems);

                } else {
                    $('#cart-item-num').addClass('hidden');

                    $('#cart-items').html('<p>Your cart is empty.</p>');
                }
            },
            error: function (error) {
                console.log("An error occurred while fetching cart items for guest:", error);
            }
        });
    }
}


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

        const token = localStorage.getItem('auth_token');

        if (token) {
            fetchUserId(token).then(isAuthenticated => {

                const headers = {};

                if (isAuthenticated) {
                    headers['Authorization'] = `Bearer ${token}`;
                }

                $.ajax({
                    url: `/api/v1/cart/`,
                    type: 'GET',
                    headers: headers,
                    dataType: 'json',
                    success: function (response) {
                        const cartId = response.cart.id;
                        clearCart(cartId);
                    }
                });
            }).catch(error => {
                console.log("An error occurred in authentication check:", error);
            });
        } else {

            $.ajax({
                url: `/api/v1/cart/`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    const cartId = response.cart.id;

                    clearCart(cartId);
                }
            });
        }
    }
});

$(document).on('click', '.clear-cart-item', function () {
    let productId = $(this).data('product-id');
    clearCartItem(productId);
});

function clearCart(cartId) {
    const token = localStorage.getItem('auth_token');

    if (token) {
        fetchUserId(token).then(isAuthenticated => {

            const headers = {};

            if (isAuthenticated) {
                headers['Authorization'] = `Bearer ${token}`;
            }
            $.ajax({
                url: `/api/v1/cart/${cartId}`,
                type: 'DELETE',
                headers: headers,
                success: function (response) {

                    $('#cart-item-num').addClass('hidden');

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
        }).catch(error => {
            console.log("An error occurred in authentication check:", error);
        });
    } else {
        $.ajax({
            url: `/api/v1/cart/${cartId}`,
            type: 'DELETE',
            success: function (response) {

                $('#cart-item-num').addClass('hidden');

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
}

function clearCartItem(productId) {
    const token = localStorage.getItem('auth_token');

    if (token) {
        fetchUserId(token).then(isAuthenticated => {

            const headers = {};

            if (isAuthenticated) {
                headers['Authorization'] = `Bearer ${token}`;
            }

            $.ajax({
                url: `/api/v1/cart-item/${productId}`,
                type: 'DELETE',
                headers: headers,
                success: function (response) {

                    fetchDefaultCart();
                    fetchCartItemNum();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error clearing cart:', textStatus, errorThrown);
                }
            });
        }).catch(error => {
            console.log("An error occurred in authentication check:", error);
        });
    } else {

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
}

$(document).on('click', '#logout', function() {
    $.ajax({
        url: '/api/v1/logout',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
        },
        success: function(response) {
            if (response.message) {
                localStorage.removeItem('auth_token');

                alert('Logged out successfully!');

                window.location.href = '/';
            } else {
                alert('Logout failed');
            }
        },
        error: function(error) {
            console.log(error);
            window.location.href = '/';
        }
    });
});