@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucwords(str_replace('-', ' ', $category)) }} Quizzes</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-slate-100 via-blue-100 to-indigo-100 min-h-screen flex flex-col">

<x-user-navbar/>

<div class="max-w-7xl mx-auto w-full px-4 py-10 flex-1">

    <!-- Header -->
    <div class="text-center mb-10">

        <h1 class="text-3xl md:text-5xl font-bold text-indigo-600">
            {{ ucwords(str_replace('-', ' ', $category)) }} Quizzes
        </h1>

        <p class="text-gray-600 mt-3 text-sm md:text-base">
            Choose a quiz and challenge your knowledge.
        </p>

    </div>

    @if(count($quizData) > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

            @foreach($quizData as $quiz)

            <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition duration-300 overflow-hidden">

                <!-- Top Bar -->
                <div class="bg-indigo-600 h-2"></div>

                <div class="p-6">

                    <div class="flex justify-between items-center mb-5">

                        <span class="text-xs font-semibold text-gray-500">
                            Quiz #{{ $quiz->id }}
                        </span>

                        <span class="bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full">
                            Available
                        </span>

                    </div>

                    <h2 class="text-xl font-bold text-gray-800 mb-5 line-clamp-2 min-h-[60px]">
                        {{ $quiz->name }}
                    </h2>

                    <div class="bg-indigo-50 rounded-2xl p-4 mb-6">

                        <p class="text-sm text-gray-500">
                            Total Questions
                        </p>

                        <p class="text-3xl font-bold text-indigo-600">
                            {{ $quiz->mcq_count }}
                        </p>

                    </div>

                    <a href="/start-quiz/{{ $quiz->id }}/{{ Str::slug($quiz->name) }}"
                       class="block w-full text-center bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">

                        🚀 Start Quiz

                    </a>

                </div>

            </div>

            @endforeach

        </div>

    @else

        <div class="bg-white rounded-3xl shadow-lg p-12 text-center max-w-2xl mx-auto">

            <div class="text-6xl mb-4">
                📚
            </div>

            <h2 class="text-3xl font-bold text-gray-700">
                No Quizzes Found
            </h2>

            <p class="text-gray-500 mt-3">
                There are currently no quizzes available in this category.
            </p>

            <a href="/all-categories"
               class="inline-block mt-6 bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition">

                Browse Categories

            </a>

        </div>

    @endif

</div>

<x-user-footer/>

</body>
</html>