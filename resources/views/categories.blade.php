<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories | Quiz System</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-slate-50 via-gray-100 to-indigo-50 min-h-screen pb-10 overflow-x-hidden">

    <x-navbar :name="$name" />

    @if(Session::has('category'))
        <div class="max-w-md mx-auto mt-6 px-4">
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-2xl shadow-sm">
                <strong class="font-semibold">Success!</strong>
                <span>{{ Session::get('category') }}</span>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 md:mt-10">

        {{-- Add Category Card --}}
        <div class="flex justify-center">

            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 md:p-8 w-full max-w-lg">

                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        Add Category
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Create new quiz categories for your platform
                    </p>
                </div>

                <form action="/add-category" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="category"
                            value="{{ old('category') }}"
                            placeholder="Enter Category Name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">

                        @error('category')
                            <p class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition shadow-md">
                        Add Category
                    </button>

                </form>

            </div>

        </div>

        {{-- Categories Section --}}
        <div class="mt-10 md:mt-14">

            <div class="text-center mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    Existing Categories
                </h1>

                <p class="text-gray-500 mt-2">
                    Manage all quiz categories from one place
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

                {{-- Desktop Table --}}
                <div class="hidden md:block">

                    <table class="w-full">

                        <thead class="bg-indigo-600 text-white">

                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">
                                    ID
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Category Name
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Creator
                                </th>

                                <th class="px-6 py-4 text-center font-semibold">
                                    Actions
                                </th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($categories as $category)

                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                <td class="px-6 py-5 text-gray-700">
                                    #{{ $category->id }}
                                </td>

                                <td class="px-6 py-5 font-semibold text-gray-800">
                                    {{ $category->name }}
                                </td>

                                <td class="px-6 py-5 text-gray-600">
                                    {{ $category->creator }}
                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex justify-center gap-3">

                                        <a href="/quiz-list/{{ $category->id }}/{{ $category->name }}"
                                           title="View Quizzes"
                                           class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition">

                                            👁️

                                        </a>

                                        <a href="/category/delete/{{ $category->id }}"
                                           onclick="return confirm('Are you sure you want to delete this category?')"
                                           title="Delete Category"
                                           class="w-10 h-10 flex items-center justify-center rounded-full bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition">

                                            🗑️

                                        </a>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="4" class="text-center py-10 text-gray-500">
                                    No categories found.
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Mobile Cards --}}
<div class="md:hidden p-4 space-y-4">

    @forelse($categories as $category)

    <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">

        {{-- Top Row --}}
        <div class="flex justify-between items-center gap-3">

            <h3 class="text-lg font-bold text-gray-800 break-all">
                {{ $category->name }}
            </h3>

            <span class="shrink-0 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                #{{ $category->id }}
            </span>

        </div>

        {{-- Creator --}}
        <div class="mt-2">
            <p class="text-sm text-gray-500">
                Created by
                <span class="font-medium text-gray-700">
                    {{ $category->creator }}
                </span>
            </p>
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 mt-4">

            <a href="/quiz-list/{{ $category->id }}/{{ $category->name }}"
               class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl font-medium transition">
                View Quizzes
            </a>

            <a href="/category/delete/{{ $category->id }}"
               onclick="return confirm('Are you sure you want to delete this category?')"
               class="flex-1 text-center bg-red-600 hover:bg-red-700 text-white py-2.5 rounded-xl font-medium transition">
                Delete
            </a>

        </div>

    </div>

    @empty

    <div class="text-center py-10 text-gray-500">
        No categories found.
    </div>

    @endforelse

</div>

            </div>

        </div>

    </div>

</body>
</html>