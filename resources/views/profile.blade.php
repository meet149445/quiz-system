<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Quiz Master</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

<x-user-navbar/>

<main class="flex-1">

    <div class="max-w-4xl mx-auto px-4 py-8">

        <!-- Profile Card -->
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-200">

            <!-- Header -->
            <div class="bg-indigo-600 px-6 md:px-10 py-10">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            {{ $user->name }}
                        </h1>

                        <p class="text-indigo-100 mt-2 break-all">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div>
                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-white text-indigo-600 font-semibold text-sm">
                            Active Member
                        </span>
                    </div>

                </div>

            </div>

            <!-- Stats -->
            <div class="p-6 md:p-8">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                    <!-- Total Quizzes -->
                    <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 text-center">

                        <p class="text-sm font-medium text-indigo-600 uppercase tracking-wide">
                            Total Quizzes
                        </p>

                        <h3 class="text-3xl font-bold text-indigo-700 mt-3">
                            {{ $totalQuizzes }}
                        </h3>

                    </div>

                    <!-- Certificates -->
                    <div class="bg-green-50 border border-green-100 rounded-2xl p-6 text-center">

                        <p class="text-sm font-medium text-green-600 uppercase tracking-wide">
                            Certificates
                        </p>

                        <h3 class="text-3xl font-bold text-green-700 mt-3">
                            {{ $certificates }}
                        </h3>

                    </div>

                    <!-- Joined -->
                    <div class="bg-purple-50 border border-purple-100 rounded-2xl p-6 text-center">

                        <p class="text-sm font-medium text-purple-600 uppercase tracking-wide">
                            Joined
                        </p>

                        <h3 class="text-lg font-bold text-purple-700 mt-3">
                            {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                        </h3>

                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end mt-8">

                    <a href="/my-results"
                       class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold text-center hover:bg-indigo-700 transition">
                        View Quiz History
                    </a>

                </div>

            </div>

        </div>

    </div>

</main>

<x-user-footer/>

</body>
</html>