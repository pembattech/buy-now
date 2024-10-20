<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div> --}}

    <main class="px-24">
        <div class="hero-section">

            <div style="background-image: public/assets/2.jpg;">


                <div class="flex gap-4">

                    <div>

                        <p class="font-bold text-6xl">Unleash Innovation in Every Byte.</p>
                        <p>Explore a World of Cutting-Edge Tech</p>

                        <a href="#" class="p-2 bg-gray-900 rounded-md">Shop now</a>

                    </div>

                    <img src="" alt="hero-img">

                </div>

            </div>
        </div>

        <div class="categories-section">
            <div class="flex justify-between">
                <p>Shop by Categories</p>

                <a href="#">Show All</a>
            </div>


            <div class="grid grid-cols-3">
                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

                <div class="category bg-gray-300 p-4">
                    <img src="" alt="Category Image">

                    <p class="bg-white">Watches</p>
                </div>

            </div>
        </div>


        <div class="new-collections-section">
            <!-- Pagination -->

            <div class="bg-gray-300">
                <img class="p-4" src="" alt="Category Image">

                <p class="bg-white">Watches</p>
            </div>

            <div class="bg-gray-300">
                <img class="p-4" src="" alt="Category Image">

                <p class="bg-white">Watches</p>
            </div>

            <div class="bg-gray-300">
                <img class="p-4" src="" alt="Category Image">

                <p class="bg-white">Watches</p>
            </div>
        </div>

        <div class="flex justify-between">

            <div>
                <p>Deals of the Month</p>

                <p>Get ready for a shopping experience like never before with our Deals of the Month! Every purchase
                    comes with exclusive perks and offers, making this month a celebration of savvy choices and amazing
                    deals. Don't miss out! [emoji-gift][emoji-cart]</p>

                <a href="#" class="p-2 bg-gray-900 rounded-md">View Product [arrow]</a>
            </div>

            <img src="" alt="Top deals of the month">

        </div>
    </main>

</x-app-layout>
