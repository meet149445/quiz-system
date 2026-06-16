<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz System - Manage Quiz</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen">

    <x-navbar :name="$name" />

    <div class="max-w-4xl mx-auto px-4 py-6 md:py-10">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-8">

            @if(!Session::has('quizDetails'))

                <div class="text-center mb-8">

                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-50 text-indigo-600 text-sm font-medium mb-4">
                        Create New Quiz
                    </div>

                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                        Add Quiz
                    </h2>

                    <p class="text-gray-500 mt-2 text-sm md:text-base">
                        Create a new quiz and assign it to a category
                    </p>

                </div>

                <form action="/add-quiz" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Quiz Name
                        </label>

                        <input
                            type="text"
                            name="quiz"
                            placeholder="Enter quiz name"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Select Category
                        </label>

                        <select
                            name="category"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                            <option value="">Choose Category</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition">
                        Create Quiz
                    </button>

                </form>

            @else

                <div class="bg-indigo-600 rounded-2xl p-5 md:p-6 text-white mb-8">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                        <div>
                            <p class="text-indigo-100 text-sm uppercase tracking-wider">
                                Current Quiz
                            </p>

                            <h2 class="text-2xl md:text-3xl font-bold mt-1 break-words">
                                {{ session('quizDetails')->name }}
                            </h2>
                        </div>

                        <div class="bg-white/10 rounded-xl px-5 py-3 text-center">
                            <p class="text-indigo-100 text-sm">
                                Total MCQs
                            </p>

                            <p class="text-3xl font-bold">
                                {{ $totalMCQs }}
                            </p>
                        </div>

                    </div>

                    @if($totalMCQs > 0)

                        <div class="mt-5">

                            <a href="/show-quiz/{{ session('quizDetails')->id }}"
                               class="inline-block bg-white text-indigo-600 px-5 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">
                                Show MCQs
                            </a>

                        </div>

                    @endif

                </div>

                <div class="text-center mb-8">

                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-50 text-indigo-600 text-sm font-medium mb-4">
                        Question Builder
                    </div>

                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                        Add MCQs
                    </h2>

                    <p class="text-gray-500 mt-2 text-sm md:text-base">
                        Add questions and answers for your quiz
                    </p>

                </div>

                <form action="add-mcq" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <textarea
                            name="question"
                            rows="4"
                            placeholder="Enter Question"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>

                        @error('question')
                            <div class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <input
                            type="text"
                            name="a"
                            placeholder="Option A"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300">

                        @error('a')
                            <div class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <input
                            type="text"
                            name="b"
                            placeholder="Option B"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300">

                        @error('b')
                            <div class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <input
                            type="text"
                            name="c"
                            placeholder="Option C"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300">

                        @error('c')
                            <div class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <input
                            type="text"
                            name="d"
                            placeholder="Option D"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300">

                        @error('d')
                            <div class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <select
                            name="correct_ans"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300">

                            <option value="">Select Correct Answer</option>
                            <option value="a">Option A</option>
                            <option value="b">Option B</option>
                            <option value="c">Option C</option>
                            <option value="d">Option D</option>

                        </select>

                        @error('correct_ans')
                            <div class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 pt-2">

                        <button
                            type="submit"
                            value="add-more"
                            name="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition">
                            Add More
                        </button>

                        <button
                            type="submit"
                            value="done"
                            name="submit"
                            class="bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">
                            Add & Submit
                        </button>

                        <a href="/end-quiz"
                           class="bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-semibold text-center transition">
                            Finish Quiz
                        </a>

                    </div>

                </form>

            @endif

        </div>

    </div>

</body>
</html>