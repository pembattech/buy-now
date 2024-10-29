<x-guest-layout>
    <main class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="container max-w-5xl px-8">
            <section class="max-w-md mx-auto p-10 bg-white rounded-lg shadow-lg">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900">Sign In</h1>
                    <p class="text-gray-700">
                        New user? <span><a href="{{ route('register') }}" class="text-blue-500 hover:underline">Create an
                                account</a></span>
                    </p>
                </div>
                <form name="signin" class="space-y-5" id="loginForm">
                    @csrf
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
                    <div class="flex justify-between items-center">
                        <a href="#" class="text-blue-500 hover:underline">Forgot Password</a>
                        <input type="submit" name="submit" value="Sign In"
                            class="px-6 py-2 bg-blue-500 text-white font-medium rounded-full cursor-pointer focus:outline-none hover:bg-blue-600">
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '/api/v1/login',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    console.log(response);
                    if (response.token) {
                        localStorage.setItem('auth_token', response.token);

                        document.cookie = 'guest_identifier' + '=; Max-Age=-99999999;';
                        alert('Logged in successfully!');

                        window.location.href = '/';

                    } else {
                        alert('Login failed');
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert('Login failed');
                }
            });
        });
    </script>
</x-guest-layout>
