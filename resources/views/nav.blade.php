<nav class="sticky top-0 bg-white">
    <div class="flex justify-between px-32 py-4"
        style="display: flex; justify-content:space-between; padding: 1rem 8rem;">
        <div class="logo">
            <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Device Store Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Device Store</span>
            </a>
        </div>

        <div>
            <a href="{{ route('dashboard') }}" class="px-1" style="padding: 0 0.25rem;">Home</a>
            <a href="{{ route('products.index') }}" class="px-1" style="padding: 0 0.25rem;">Shop</a>
            <a href="#" class="p-2 bg-gray-800 rounded-md hover:bg-gray-900 text-white">Login</a>
        </div>
    </div>
</nav>