<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quizName }} | Quiz Master</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<x-user-navbar />

<div class="flex-1">

    <div class="max-w-4xl mx-auto px-4 py-8">

        <!-- Quiz Header -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-indigo-600 text-white p-8 text-center">

                <h1 class="text-2xl md:text-4xl font-bold break-words">
                    {{ ucwords(str_replace('-', ' ', $quizName)) }}
                </h1>

                <p class="mt-2 text-indigo-100">
                    Test your knowledge and improve your skills
                </p>

            </div>

            <div class="p-6 md:p-8">

                <!-- Stats -->
                <div class="grid grid-cols-2 gap-4 mb-8">

                    <div class="bg-indigo-50 rounded-xl p-5 text-center">

                        <p class="text-sm text-gray-500 mb-1">
                            Total Questions
                        </p>

                        <h2 class="text-3xl font-bold text-indigo-600">
                            {{ $quizCount }}
                        </h2>

                    </div>

                    <div class="bg-green-50 rounded-xl p-5 text-center">

                        <p class="text-sm text-gray-500 mb-1">
                            Required
                        </p>

                        <h2 class="text-3xl font-bold text-green-600">
                            100%
                        </h2>

                    </div>

                </div>

                <!-- Instructions -->
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mb-8">

                    <h3 class="font-bold text-lg text-gray-800 mb-4">
                        Quiz Instructions
                    </h3>

                    <ul class="space-y-3 text-gray-600">

                        <li>✅ All questions are compulsory.</li>

                        <li>✅ Read each question carefully before answering.</li>

                        <li>✅ Select the best answer from the available options.</li>

                        <li>✅ Your score will be calculated automatically.</li>

                        <li>✅ Complete the quiz before leaving the page.</li>

                    </ul>

                </div>

                <!-- Action Area -->
                <div class="text-center">

                    @if(session('user'))

                        @if($quizCount > 0)

                            <a href="/mcq/{{ $quizId }}/{{ str_replace(' ','-',strtolower($quizName)) }}"
                               class="inline-flex items-center justify-center bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition shadow-md">

                                🚀 Start Quiz

                            </a>

                        @else

                            <button disabled
                                class="bg-gray-400 text-white px-8 py-3 rounded-xl cursor-not-allowed font-semibold">

                                No Questions Available

                            </button>

                        @endif

                    @else

                        <div class="flex flex-col sm:flex-row justify-center gap-4">

                            <a href="/user-signup"
                               class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">

                                Create Account

                            </a>

                            <a href="/user-login"
                               class="bg-green-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-green-700 transition">

                                Login

                            </a>

                        </div>

                        <p class="text-sm text-gray-500 mt-5">
                            Please login or create an account to start this quiz.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

<x-user-footer />

</body>
</html>