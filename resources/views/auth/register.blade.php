<x-guest-layout>
    <main class="register-page hidden flex items-center justify-center min-h-screen bg-gray-100">
        <div class="container max-w-5xl px-8">
            <section class="max-w-md mx-auto p-10 bg-white rounded-lg shadow-lg">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900">Create Account</h1>
                    <p class="text-gray-700">
                        Already have an account? <span><a href="{{ route('login') }}" class="text-blue-500 hover:underline">Sign In</a></span>
                    </p>
                </div>
                <form name="register" class="space-y-5" id="registerForm">
                    @csrf
                    <div class="space-y-1">
                        <label for="name" class="sr-only">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Full Name"
                            class="w-full px-4 py-3 rounded-full bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="space-y-1">
                        <label for="email" class="sr-only">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Email Address"
                            class="w-full px-4 py-3 rounded-full bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="space-y-1">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="w-full px-4 py-3 rounded-full bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="space-y-1">
                        <label for="password_confirmation" class="sr-only">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"
                            class="w-full px-4 py-3 rounded-full bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex justify-between items-center">
                        <input type="submit" name="submit" value="Create Account"
                            class="px-6 py-2 bg-blue-500 text-white font-medium rounded-full cursor-pointer focus:outline-none hover:bg-blue-600">
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
             $(document).ready(function() {
            const token = localStorage.getItem('auth_token');

            if (token) {
                window.location.href = "/";
            } else {
                $('.register-page').removeClass('hidden');
            }
        });

        $('#registerForm').on('submit', function(e) {
            e.preventDefault();

            console.log($(this).serialize());

            $.ajax({
                url: `/api/v1/register`,
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.user) {
                        alert('Registration successful! Please log in.');
                        window.location.href = '/login';
                    } else {
                        alert('Registration failed');
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert('Registration failed');
                }
            });
        });
    </script>
</x-guest-layout>
