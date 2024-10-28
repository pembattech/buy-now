<nav class="sticky top-0 bg-white">
    <div class="flex justify-between items-center px-32">
        <div class="logo">
            <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">

                <svg class="hover:fill-gray-800 w-20 h-auto text-center" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 128 160"
                    enable-background="new 0 0 128 128" xml:space="preserve">
                    <g>
                        <path
                            d="M112.728,88.646c-0.188-0.188-0.441-0.293-0.707-0.293l-12.693,0.003V85.99c0-0.553-0.447-1-1-1L62.24,84.989   c-0.075,0-0.149,0.009-0.221,0.024c-0.222-0.015-0.446-0.023-0.671-0.023c-2.954,0-5.71,1.142-7.782,3.214   c-2.073,2.072-3.215,4.828-3.215,7.759c0,6.049,4.923,10.973,10.973,10.976c0.001,0,0.001,0,0.001,0   c0.241,0,0.479-0.01,0.714-0.026c0.064,0.016,0.132,0.023,0.199,0.023l36.089,0.003c0.266,0,0.52-0.105,0.707-0.293   s0.293-0.441,0.293-0.707v-2.367h12.693c0.553,0,1-0.447,1-1V89.353C113.021,89.087,112.915,88.833,112.728,88.646z M97.327,89.355   v13.216v2.367l-34.825-0.003c-0.089-0.027-0.181-0.042-0.274-0.042c-0.025,0-0.052,0.001-0.078,0.003   c-0.271,0.024-0.544,0.042-0.824,0.042c-4.948-0.003-8.974-4.029-8.974-8.976c0-4.947,4.024-8.973,8.972-8.973h0.001   c0.295,0,0.565,0.017,0.828,0.04c0.132,0.013,0.262-0.004,0.384-0.041l34.791,0.001V89.355z M111.021,101.571H99.327V90.355   l11.693-0.003V101.571z" />
                        <path
                            d="M103.216,98.9l3.892,0.002v0.181c0,0.553,0.447,1,1,1s1-0.447,1-1v-1.181c0-0.552-0.447-1-1-1l-4.892-0.002   c-0.552,0-1,0.447-1,1C102.216,98.452,102.663,98.9,103.216,98.9z" />
                        <path
                            d="M103.217,95.025L103.217,95.025l4.892-0.004c0.552,0,0.999-0.448,0.999-1v-1.176c0-0.553-0.447-1-1-1s-1,0.447-1,1v0.177   l-3.892,0.003c-0.552,0-0.999,0.448-0.999,1.001C102.217,94.578,102.665,95.025,103.217,95.025z" />
                        <path
                            d="M106.515,74.271v-4.281c0-0.553-0.447-1-1-1h-6.762c0.112-0.314,0.185-0.647,0.185-1V24.062c0-1.654-1.346-3-3-3H34.734   c-1.654,0-3,1.346-3,3v19.29H19.431c-2.454,0-4.451,1.995-4.451,4.447v47.387c0,2.453,1.997,4.449,4.451,4.449h22.636   c2.451,0,4.445-1.996,4.445-4.449V81.823H98.96C103.126,81.823,106.515,78.436,106.515,74.271z M44.512,95.186   c0,1.351-1.097,2.449-2.445,2.449H19.431c-1.352,0-2.451-1.099-2.451-2.449v-2.773h27.532V95.186z M44.512,90.412H16.979V52.574   h27.532V90.412z M44.512,50.574H16.979v-2.775c0-1.35,1.1-2.447,2.451-2.447h22.636c1.349,0,2.445,1.098,2.445,2.447V50.574z    M42.066,43.352h-8.332v-19.29c0-0.551,0.448-1,1-1h61.203c0.552,0,1,0.449,1,1v43.928c0,0.552-0.448,1-1,1H53.194h-6.683v-21.19   C46.512,45.347,44.518,43.352,42.066,43.352z M46.512,70.989h6.683h42.743h8.577v3.281c0,3.062-2.492,5.553-5.555,5.553H46.512   V70.989z" />
                        <path
                            d="M30.747,96.963c1.005,0,1.823-0.82,1.823-1.828c0-1.007-0.818-1.826-1.823-1.826c-1.009,0-1.829,0.819-1.829,1.826   C28.918,96.143,29.738,96.963,30.747,96.963z M30.747,94.963c0.096,0,0.171,0.075,0.171,0.172c-0.001,0.198-0.349,0.194-0.348,0   C30.57,95.04,30.649,94.963,30.747,94.963z" />
                    </g>
                </svg>

                <span class="self-center text-2xl font-semibold whitespace-nowrap">Device Store</span>
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}" class="mx-1 hover:underline">Home</a>
            <a href="{{ route('products.index') }}" class="mx-1 hover:underline">Shop</a>
            <div class="relative">
                <a href="{{ route('carts.index') }}" class="mx-1">
                    <svg class="hover:fill-gray-800 w-12 h-12" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"
                        style="enable-background:new 0 0 100 100;" xml:space="preserve">
                        <polygon points="87.18,36.44 89.09,25.08 76.54,25.08 74.63,36.44 " />
                        <polygon points="75.05,25.08 59.88,25.08 59.88,36.44 73.12,36.44 " />
                        <polygon points="72.88,37.91 59.88,37.91 59.88,49.7 70.9,49.7 " />
                        <polygon points="86.93,37.91 74.38,37.91 72.39,49.7 84.95,49.7 " />
                        <polygon points="70.25,62.5 82.8,62.5 84.71,51.17 72.16,51.17 " />
                        <polygon points="70.66,51.17 59.88,51.17 59.88,62.5 68.76,62.5 " />
                        <polygon points="58.41,62.5 58.41,51.17 47.64,51.17 49.55,62.5 " />
                        <polygon points="58.41,37.91 45.42,37.91 47.39,49.7 58.41,49.7 " />
                        <polygon points="58.41,36.44 58.41,25.08 43.26,25.08 45.17,36.44 " />
                        <polygon points="43.67,36.44 41.77,25.08 29.2,25.08 31.1,36.44 " />
                        <polygon points="31.36,37.91 33.34,49.7 45.89,49.7 43.91,37.91 " />
                        <polygon points="48.06,62.5 46.15,51.17 33.58,51.17 35.48,62.5 " />
                        <path
                            d="M68.72,84.33c0,2.24,1.85,4.09,4.09,4.09c2.26,0,4.09-1.85,4.09-4.09c0-2.26-1.83-4.09-4.09-4.09 C70.57,80.24,68.72,82.07,68.72,84.33z" />
                        <path
                            d="M41.4,84.33c0,2.24,1.85,4.09,4.09,4.09c2.26,0,4.09-1.85,4.09-4.09c0-2.26-1.83-4.09-4.09-4.09 C43.24,80.24,41.4,82.07,41.4,84.33z" />
                        <path
                            d="M12.13,14.04h11.22l8.41,49.93h-2.61c-4.24,0-7.7,3.32-7.7,7.39c0,4.09,3.46,7.41,7.7,7.41h53.94 c0.69,0,1.24-0.55,1.24-1.22c0-0.69-0.55-1.24-1.24-1.24H29.14c-2.89,0-5.24-2.22-5.24-4.95s2.36-4.93,5.24-4.93h53.94 c0.69,0,1.24-0.57,1.24-1.24c0-0.67-0.55-1.22-1.24-1.22H69.47c-0.02,0-0.06,0.04-0.1,0.04c-0.04,0-0.08-0.02-0.12-0.02 c-0.04,0-0.06-0.02-0.08-0.02H49.12c-0.02,0-0.04,0.02-0.06,0.02c-0.06,0-0.1,0.02-0.14,0.02c-0.04,0-0.06-0.04-0.1-0.04H34.25 L25.6,12.61c-0.1-0.61-0.61-1.02-1.22-1.02H12.13c-0.67,0-1.22,0.55-1.22,1.22C10.91,13.47,11.46,14.04,12.13,14.04z" />
                    </svg>
                </a>
                <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full top-4 end-1 hidden"
                    id="cart-item-num"></div>
            </div>

            <div id="auth">
                {{--  --}}
            </div>

        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#logoutButton').on('click', function() {
        const token = localStorage.getItem('auth_token'); // Retrieve the token from local storage

        // Make sure token exists before attempting to log out
        if (token) {
            $.ajax({
                url: '/api/logout', // The logout route
                type: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`, // Send the token in the Authorization header
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                },
                success: function(response) {
                    // Assuming the backend responds with a success message
                    console.log(response.message || 'Logged out successfully!');
                    localStorage.removeItem('auth_token'); // Clear the token from local storage
                    // Optionally redirect or update the UI
                    // window.location.href = '/login'; // Uncomment to redirect to login page
                },
                error: function(error) {
                    console.log("Logout failed:", error);
                }
            });
        } else {
            console.log("No token found. User is already logged out.");
        }
    });
</script>
