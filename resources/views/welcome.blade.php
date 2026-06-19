@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Master</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<x-user-navbar />

{{-- Success Message --}}
@if(session('success'))
<div class="max-w-6xl mx-auto mt-4 px-4 w-full">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
</div>
@endif

{{-- Error Message --}}
@if(session('error'))
<div class="max-w-6xl mx-auto mt-4 px-4 w-full">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
        {{ session('error') }}
    </div>
</div>
@endif

<main class="flex-1">

    {{-- Hero Section --}}
    <section class="max-w-6xl mx-auto px-4 py-12">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-8 md:p-14 text-white shadow-xl">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                    📚 Quiz Master
                </h1>
                <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto">
                    Test your knowledge, challenge yourself, earn certificates,
                    and improve your skills with hundreds of quizzes.
                </p>
            </div>
            {{-- Search --}}
            <div class="max-w-2xl mx-auto mt-10">
                <form action="/search-quiz" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input
    type="text"
    name="search"
    placeholder="Search here..."
    class="flex-1 px-5 py-4 rounded-xl bg-white text-gray-800 border-2 border-indigo-200 shadow-xl placeholder-gray-500 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-300 outline-none font-medium transition">
                    <button
                        type="submit"
                        class="bg-white text-indigo-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition">
                        🔍 Search
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                <div class="text-4xl mb-3">📂</div>
                <h3 class="text-gray-500 font-medium">Categories</h3>
                <p class="text-4xl font-bold text-indigo-600 mt-2">{{ $categories->count() }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                <div class="text-4xl mb-3">📝</div>
                <h3 class="text-gray-500 font-medium">Top Quizzes</h3>
                <p class="text-4xl font-bold text-green-600 mt-2">{{ count($topQuizzes) }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                <div class="text-4xl mb-3">🏆</div>
                <h3 class="text-gray-500 font-medium">Certificates</h3>
                <p class="text-4xl font-bold text-purple-600 mt-2">Available</p>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section class="max-w-6xl mx-auto px-4 py-14">

        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-indigo-600">📂 Quiz Categories</h2>
            <p class="text-gray-500 mt-2">Choose your favorite category and start learning.</p>
        </div>

        {{-- Mobile: Cards --}}
        <div class="grid md:hidden grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($categories as $category)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $category->name }}</h3>
                    <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Active</span>
                </div>
                <p class="text-gray-500 mb-2">Available Quizzes</p>
                <div class="text-3xl font-bold text-indigo-600 mb-6">{{ $category->quizzes_count }}</div>
                <a href="/user-quiz-list/{{ $category->id }}/{{ Str::slug($category->name) }}"
                   class="block text-center bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition">
                    View Quizzes
                </a>
            </div>
            @endforeach
        </div>

        {{-- Desktop: Table --}}
        <div class="hidden md:block bg-white rounded-2xl shadow-md overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide">#</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide">Category Name</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide text-center">Available Quizzes</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide text-center">Status</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($categories as $index => $category)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="px-6 py-4 text-gray-400 text-sm font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 font-bold text-sm">
                                    {{ strtoupper(substr($category->name, 0, 2)) }}
                                </div>
                                <span class="font-semibold text-gray-800">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-2xl font-bold text-indigo-600">{{ $category->quizzes_count }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">Active</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="/user-quiz-list/{{ $category->id }}/{{ Str::slug($category->name) }}"
                               class="inline-block bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                View Quizzes
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>

    {{-- Top Quizzes --}}
    <section class="max-w-6xl mx-auto px-4 pb-14">

        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-indigo-600">🏆 Top Quizzes</h2>
            <p class="text-gray-500 mt-2">Most popular quizzes on Quiz Master.</p>
        </div>

        {{-- Mobile: Cards --}}
        <div class="grid md:hidden grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($topQuizzes as $quiz)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm text-gray-500">Quiz #{{ $quiz->id }}</span>
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">Popular</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $quiz->name }}</h3>
                <div class="mb-6">
                    <p class="text-gray-500 text-sm">Questions</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $quiz->mcq_count }}</p>
                </div>
                <a href="/start-quiz/{{ $quiz->id }}/{{ Str::slug($quiz->name) }}"
                   class="block text-center bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition">
                    Attempt Quiz
                </a>
            </div>
            @endforeach
        </div>

        {{-- Desktop: Table --}}
        <div class="hidden md:block bg-white rounded-2xl shadow-md overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide">#</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide">Quiz Name</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide text-center">Questions</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide text-center">Badge</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wide text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($topQuizzes as $index => $quiz)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="px-6 py-4 text-gray-400 text-sm font-medium">{{ $quiz->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 font-bold text-sm">
                                    🏆
                                </div>
                                <span class="font-semibold text-gray-800">{{ $quiz->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-2xl font-bold text-indigo-600">{{ $quiz->mcq_count }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-medium">Popular</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="/start-quiz/{{ $quiz->id }}/{{ Str::slug($quiz->name) }}"
                               class="inline-block bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                Attempt Quiz
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>

    {{-- CTA --}}
    <section class="max-w-6xl mx-auto px-4 pb-14">
        <div class="bg-white rounded-3xl shadow-lg p-10 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Ready to Challenge Yourself?</h2>
            <p class="text-gray-500 mt-3">Explore hundreds of quizzes and earn certificates.</p>
            <a href="/categories-list"
               class="inline-block mt-6 bg-indigo-600 text-white px-8 py-3 rounded-xl hover:bg-indigo-700 transition">
                Browse Categories
            </a>
        </div>
    </section>

</main>

<x-user-footer />

</body>
</html>