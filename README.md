# BuyNow eCommerce Platform

BuyNow is a fully-featured eCommerce platform built using Laravel. It provides secure token-based authentication with Laravel Sanctum, allowing both guest and registered users to place, track, and manage orders seamlessly. The platform also includes product filtering, easy guest checkout via cookies, and an intuitive frontend built with Laravel Blade.

## Features

-   **User Authentication**: Secure login and registration for users, with token-based authentication using Laravel Sanctum.
-   **Order Management**: Users can place, track, and manage orders easily.
-   **Guest Checkout**: Allows guest users to place orders without needing to register, using a unique guest identifier stored in cookies.
-   **Product Filtering**: Advanced filtering options on the product API for better search functionality.
-   **Responsive Frontend**: Built with Laravel Blade, optimized for a smooth user experience across devices.
-   **Admin Features**: Admin users can manage products, orders, and users efficiently through a secure interface.

## API Endpoints

#### **User Authentication**

- **Register a new user.**
  `POST /api/v1/register`

- **Log in a registered user.**
  `POST /api/v1/login`

- **Log out the user.**
  `POST /api/v1/logout`

---

#### **Cart Management**

- **Retrieve the current cart for a guest (using cookies) or logged-in user.**
  `GET /api/v1/cart`

- **Create the cart for guests or registered users.**
  `POST /api/v1/cart`

- **Add an item to the cart for guests or registered users.**
  `POST /api/v1/cart-item`

- **Remove an item from the cart.**
  `DELETE /api/v1/cart-item/{product_id}`

- **Clear all items from the cart (for guest or registered user).**
  `DELETE /api/v1/cart/{cart_id}`

---

#### **Product Catalog**

- **List all products with pagination.**
  `GET /api/v1/products`

- **Retrieve details for a specific product.**
  `GET /api/v1/products/{product_id}`


#### **Filtering Query Parameters for Products**

-   **Filter by ID**:
    `GET /api/v1/products?id[eq]=1`
-   **Filter by Name**:
    `GET /api/v1/products?name[eq]=example`
-   **Filter by Price**:
    -   **Equal**:
        `GET /api/v1/products?price[eq]=20`
    -   **Greater Than**:
        `GET /api/v1/products?price[gt]=20`
    -   **Less Than**:
        `GET /api/v1/products?price[lt]=50`
-   **Filter by Stock**:
    -   **Equal**:
        `GET /api/v1/products?stock[eq]=100`
    -   **Greater Than**:
        `GET /api/v1/products?stock[gt]=50`
    -   **Less Than**:
        `GET /api/v1/products?stock[lt]=10`
-   **Filter by Name with Like**:
    `GET /api/v1/products?name[like]=%example%`
