<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login | Quiz Master</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<x-user-navbar />

<!-- Alerts -->
@if(session('success'))
<div class="max-w-md mx-auto mt-6 px-4 w-full">
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
</div>
@endif

@if(session('error'))
<div class="max-w-md mx-auto mt-6 px-4 w-full">
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
        {{ session('error') }}
    </div>
</div>
@endif

<div class="flex-1 flex items-center justify-center px-4 py-10">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-indigo-600 text-white p-6 text-center">

            <h1 class="text-2xl md:text-3xl font-bold">
                Welcome Back
            </h1>

            <p class="mt-2 text-indigo-100 text-sm">
                Login to continue your quiz journey
            </p>

        </div>

        <!-- Form Area -->
        <div class="p-6 md:p-8">

            @error('user')
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    {{ $message }}
                </div>
            @enderror

            <form action="user-login" method="POST" class="space-y-5">
                @csrf

                <div>

                    <label class="block text-gray-700 font-medium mb-2">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">

                    @error('email')
                        <div class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div>

                    <label class="block text-gray-700 font-medium mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">

                    @error('password')
                        <div class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button
                    type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">

                    Login

                </button>

            </form>

            <!-- Links -->
            <div class="text-center mt-6 space-y-3">

                <div>
                    <a href="/user-forgot-password"
                       class="text-indigo-600 hover:text-indigo-800 hover:underline text-sm font-medium">
                        Forgot Password?
                    </a>
                </div>

                <div class="text-sm text-gray-600">

                    Don't have an account?

                    <a href="/user-signup"
                       class="text-indigo-600 font-semibold hover:underline">
                        Create Account
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<x-user-footer />

</body>
</html>