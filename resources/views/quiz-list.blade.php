<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category }} Quizzes | Quiz Master Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen">

    <x-navbar :name="$name" />

    <div class="max-w-6xl mx-auto px-4 py-8">

        <!-- Header -->
        <div class="bg-indigo-600 rounded-3xl shadow-lg p-8 text-center mb-8">

            <h1 class="text-3xl md:text-4xl font-bold text-white">
                {{ $category }} Quizzes
            </h1>

            <p class="text-indigo-100 mt-2">
                Manage and view quizzes in this category
            </p>

        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">

            @if(count($quizData) > 0)

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[600px]">

                        <thead class="bg-indigo-600 text-white">

                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">
                                    ID
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Quiz Name
                                </th>

                                <th class="px-6 py-4 text-center font-semibold">
                                    Action
                                </th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($quizData as $quiz)

                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $quiz->id }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $quiz->name }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex justify-center">

                                        <a href="/show-quiz/{{ $quiz->id }}"
                                           class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 hover:bg-indigo-600 hover:text-white transition duration-300 shadow-sm"
                                           title="Show MCQs">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="22"
                                                 height="22"
                                                 viewBox="0 -960 960 960"
                                                 fill="currentColor">
                                                <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 112q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Z"/>
                                            </svg>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="py-16 px-6 text-center">

                    <div class="text-6xl mb-4">
                        📚
                    </div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        No Quizzes Found
                    </h2>

                    <p class="text-gray-500 mt-2">
                        No quizzes have been added to this category yet.
                    </p>

                </div>

            @endif

        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">

            <a href="/admin-categories"
               class="inline-flex items-center bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-800 transition">
                ← Back to Categories
            </a>

        </div>

    </div>

</body>
</html>