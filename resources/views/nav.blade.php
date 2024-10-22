<nav class="sticky top-0 bg-white">
    <div class="flex justify-between items-center px-32">
        <div class="logo">
            <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Device Store Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Device Store</span>
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}" class="mx-1 hover:underline">Home</a>
            <a href="{{ route('products.index') }}" class="mx-1 hover:underline">Shop</a>
            <div class="relative">
                <a href="{{ route('carts.index') }}" class="mx-1">
                    <svg class="hover:fill-gray-800 w-12 h-12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" 
                        x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve">
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
                        <path d="M68.72,84.33c0,2.24,1.85,4.09,4.09,4.09c2.26,0,4.09-1.85,4.09-4.09c0-2.26-1.83-4.09-4.09-4.09 C70.57,80.24,68.72,82.07,68.72,84.33z" />
                        <path d="M41.4,84.33c0,2.24,1.85,4.09,4.09,4.09c2.26,0,4.09-1.85,4.09-4.09c0-2.26-1.83-4.09-4.09-4.09 C43.24,80.24,41.4,82.07,41.4,84.33z" />
                        <path d="M12.13,14.04h11.22l8.41,49.93h-2.61c-4.24,0-7.7,3.32-7.7,7.39c0,4.09,3.46,7.41,7.7,7.41h53.94 c0.69,0,1.24-0.55,1.24-1.22c0-0.69-0.55-1.24-1.24-1.24H29.14c-2.89,0-5.24-2.22-5.24-4.95s2.36-4.93,5.24-4.93h53.94 c0.69,0,1.24-0.57,1.24-1.24c0-0.67-0.55-1.22-1.24-1.22H69.47c-0.02,0-0.06,0.04-0.1,0.04c-0.04,0-0.08-0.02-0.12-0.02 c-0.04,0-0.06-0.02-0.08-0.02H49.12c-0.02,0-0.04,0.02-0.06,0.02c-0.06,0-0.1,0.02-0.14,0.02c-0.04,0-0.06-0.04-0.1-0.04H34.25 L25.6,12.61c-0.1-0.61-0.61-1.02-1.22-1.02H12.13c-0.67,0-1.22,0.55-1.22,1.22C10.91,13.47,11.46,14.04,12.13,14.04z" />
                    </svg>
                </a>
                <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full top-4 end-1 hidden" id="cart-item-num"></div>
            </div>
            
            <a href="#" class="mx-1 p-2 bg-gray-800 rounded-md hover:bg-gray-900 text-white">Login</a>
        </div>
    </div>
</nav>
