<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz System - Admin Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

            <div class="text-center mb-8">

                <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-50 text-indigo-600 text-sm font-medium mb-4">
                    Admin Portal
                </div>

                <h2 class="text-3xl font-bold text-gray-900">
                    Admin Login
                </h2>

                <p class="text-gray-500 mt-2">
                    Sign in to manage quizzes and users
                </p>

                @error('user')
                    <div class="mt-4 bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <form action="admin-login" method="post" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Admin Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter Admin Name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                    @error('name')
                        <div class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter Password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                    @error('password')
                        <div class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition">
                    Login
                </button>

                <div class="text-center mt-6 space-y-3">

                <div>
                    <a href="/"
                       class="text-indigo-600 hover:text-indigo-800 hover:underline text-sm font-medium">
                        Forgot Password?
                    </a>
                </div>

                

            </div>

            </form>

        </div>

    </div>

</body>

</html>