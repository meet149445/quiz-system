<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Questions | Quiz Master Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <x-navbar :name="$name" />

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-3xl font-bold text-indigo-600">
                        Quiz Questions
                    </h1>

                    <p class="text-gray-500 mt-1">
                        View all MCQs added to this quiz
                    </p>
                </div>

                <div class="bg-indigo-50 px-5 py-3 rounded-xl text-center">

                    <p class="text-sm text-gray-500">
                        Total Questions
                    </p>

                    <p class="text-2xl font-bold text-indigo-600">
                        {{ count($mcqs) }}
                    </p>

                </div>

            </div>

        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    <thead class="bg-indigo-600 text-white">

                        <tr>
                            <th class="px-4 py-4 text-center">#</th>
                            <th class="px-4 py-4 text-left">Question</th>
                            <th class="px-4 py-4 text-left">Option A</th>
                            <th class="px-4 py-4 text-left">Option B</th>
                            <th class="px-4 py-4 text-left">Option C</th>
                            <th class="px-4 py-4 text-left">Option D</th>
                            <th class="px-4 py-4 text-center">Answer</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($mcqs as $mcq)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="px-4 py-4 text-center font-semibold text-gray-700">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-800">
                                {{ $mcq->question }}
                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                {{ $mcq->a }}
                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                {{ $mcq->b }}
                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                {{ $mcq->c }}
                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                {{ $mcq->d }}
                            </td>

                            <td class="px-4 py-4 text-center">

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold uppercase">
                                    {{ $mcq->correct_ans }}
                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="py-12 text-center text-gray-500">

                                <div class="flex flex-col items-center">

                                    <span class="text-5xl mb-3">
                                        📝
                                    </span>

                                    <p class="text-lg font-medium">
                                        No Questions Found
                                    </p>

                                    <p class="text-sm text-gray-400 mt-1">
                                        This quiz doesn't contain any MCQs yet.
                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Back Button -->
        <div class="mt-6">

            <a href="/add-quiz"
               class="inline-flex items-center bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition shadow-md">
                ← Back to Quiz
            </a>

        </div>

    </div>

</body>
</html>