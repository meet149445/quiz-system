<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Quiz Master</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<x-user-navbar />

<div class="flex-1 flex items-center justify-center px-4 py-10">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-indigo-600 text-white p-6 text-center">

            <h1 class="text-2xl md:text-3xl font-bold">
                Forgot Password
            </h1>

            <p class="mt-2 text-indigo-100 text-sm">
                Reset your account password securely
            </p>

        </div>

        <!-- Content -->
        <div class="p-6 md:p-8">

            @if(session('success'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <p class="text-gray-600 text-sm mb-6">
                Enter your registered email address and we'll send you a password reset link.
            </p>

            <form action="/user-forgot-password" method="POST" class="space-y-5">
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

                <button
                    type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">

                    Send Reset Link

                </button>

            </form>

            <div class="text-center mt-6">

                <a href="/user-login"
                   class="text-indigo-600 font-medium hover:text-indigo-800 hover:underline">

                    ← Back to Login

                </a>

            </div>

        </div>

    </div>

</div>

<x-user-footer />

</body>
</html>