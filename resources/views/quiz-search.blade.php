<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results | Quiz Master</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

<x-user-navbar />

<main class="flex-1">

    <div class="max-w-6xl mx-auto px-4 py-8">

        <!-- Hero Section -->
        <div class="bg-indigo-600 rounded-3xl shadow-lg p-8 text-center mb-8">

            <h1 class="text-3xl md:text-4xl font-bold text-white">
                🔍 Search Results
            </h1>

            <p class="text-indigo-100 mt-3">
                Results for
                <span class="font-semibold text-white">
                    "{{ $search }}"
                </span>
            </p>

        </div>

        <!-- Back Button -->
        <div class="mb-8">

            <a href="/"
               class="inline-flex items-center bg-gray-700 text-white px-5 py-3 rounded-xl font-semibold hover:bg-gray-800 transition">
                ← Back to Home
            </a>

        </div>

        @if($quizData->count())

            <!-- Results Count -->
            <div class="mb-6">

                <p class="text-gray-600 font-medium">
                    Found
                    <span class="text-indigo-600 font-bold">
                        {{ $quizData->count() }}
                    </span>
                    quiz(es)
                </p>

            </div>

            <!-- Quiz Cards -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($quizData as $quiz)

                <div class="bg-white rounded-3xl shadow-md border border-gray-200 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <div class="mb-4">

                        <h2 class="text-xl font-bold text-gray-900">
                            {{ $quiz->name }}
                        </h2>

                    </div>

                    <div class="mb-6">

                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm font-medium">
                            {{ $quiz->mcq_count }} Questions
                        </span>

                    </div>

                    <a href="/start-quiz/{{ $quiz->id }}/{{ \Illuminate\Support\Str::slug($quiz->name) }}"
                       class="block w-full text-center bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                        Start Quiz
                    </a>

                </div>

                @endforeach

            </div>

        @else

            <!-- Empty State -->
            <div class="bg-white rounded-3xl shadow-lg border border-gray-200 p-12 text-center">

                <div class="text-6xl mb-4">
                    😔
                </div>

                <h2 class="text-2xl font-bold text-gray-800">
                    No Quiz Found
                </h2>

                <p class="text-gray-500 mt-3">
                    We couldn't find any quizzes matching
                    <strong>"{{ $search }}"</strong>.
                </p>

                <a href="/"
                   class="inline-block mt-6 bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                    Browse Categories
                </a>

            </div>

        @endif

    </div>

</main>

<x-user-footer />

</body>
</html>