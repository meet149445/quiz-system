
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-slate-100 via-blue-100 to-indigo-100 min-h-screen flex flex-col">

<x-user-navbar />

@if(session('success'))
<div class="max-w-4xl mx-auto mt-4 px-4 w-full">
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl shadow">
        {{ session('success') }}
    </div>
</div>
@endif

@if(session('error'))
<div class="max-w-4xl mx-auto mt-4 px-4 w-full">
    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl shadow">
        {{ session('error') }}
    </div>
</div>
@endif

<div class="flex-1 flex items-center justify-center px-4 py-10">

    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="bg-indigo-600 text-white text-center py-8 px-6">

            <div class="text-5xl mb-3">
                👤
            </div>

            <h1 class="text-3xl font-bold">
                User Signup
            </h1>

            <p class="text-indigo-100 mt-2 text-sm">
                Create your account and start taking quizzes.
            </p>

        </div>

        <!-- Form -->
        <div class="p-8">

            @error('user')
                <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-5">
                    {{ $message }}
                </div>
            @enderror

            <form action="user-signup" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter Full Name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    @error('name')
                        <div class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter Email Address"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    @error('email')
                        <div class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    @error('password')
                        <div class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirm"
                        placeholder="Confirm Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    @error('password_confirm')
                        <div class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition shadow-md">

                    Create Account

                </button>

            </form>

            <div class="text-center mt-6">

                <p class="text-gray-500 text-sm">
                    Already have an account?
                </p>

                <a href="/user-login"
                   class="text-indigo-600 hover:text-indigo-800 font-medium hover:underline">

                    Login Here

                </a>

            </div>

        </div>

    </div>

</div>

<x-user-footer />

</body>
</html>
```
