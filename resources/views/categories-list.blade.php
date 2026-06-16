@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | Quiz System</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <x-user-navbar />

    <main class="flex-1 w-full">
        <div class="max-w-6xl mx-auto px-4 py-6 md:py-10">

            <div class="text-center mb-6 md:mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-indigo-600">
                    📚 All Categories
                </h1>
                <p class="text-sm md:text-base text-gray-500 mt-2">
                    Browse all quiz categories available on Quiz System.
                </p>
            </div>

<div class="bg-white rounded-2xl shadow-md overflow-hidden">

    {{-- Desktop Table --}}
    <div class="hidden md:block overflow-x-auto">

        <table class="w-full">

            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left">S No.</th>
                    <th class="px-6 py-4 text-left">Category</th>
                    <th class="px-6 py-4 text-left">Quizzes</th>
                    <th class="px-6 py-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categories as $key => $category)

                <tr class="border-b hover:bg-indigo-50 transition">

                    <td class="px-6 py-4">
                        {{ ($categories->currentPage() - 1) * $categories->perPage() + $key + 1 }}
                    </td>

                    <td class="px-6 py-4 font-medium">
                        {{ $category->name }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            {{ $category->quizzes_count }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <a href="/user-quiz-list/{{ $category->id }}/{{ Str::slug($category->name) }}"
                           class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            View Quizzes
                        </a>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center py-8 text-gray-500">
                        No categories found.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden p-4 space-y-4">

        @forelse($categories as $key => $category)

        <div class="border rounded-2xl p-4 shadow-sm">

            <div class="flex justify-between items-center">

                <h3 class="font-bold text-lg text-gray-800">
                    {{ $category->name }}
                </h3>

                <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">
                    #{{ ($categories->currentPage() - 1) * $categories->perPage() + $key + 1 }}
                </span>

            </div>

            <div class="mt-3">
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                    {{ $category->quizzes_count }} Quiz{{ $category->quizzes_count != 1 ? 'zes' : '' }}
                </span>
            </div>

            <a href="/user-quiz-list/{{ $category->id }}/{{ Str::slug($category->name) }}"
               class="block mt-4 text-center bg-indigo-600 text-white py-2.5 rounded-xl hover:bg-indigo-700">
                View Quizzes
            </a>

        </div>

        @empty

        <div class="text-center py-8 text-gray-500">
            No categories found.
        </div>

        @endforelse

    </div>

</div>
```


            <div class="mt-6 md:mt-8 overflow-x-auto">
                {{ $categories->links() }}
            </div>

            <div class="text-center mt-6 md:mt-8">
                <a href="/"
                   class="inline-block bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
                    ← Back to Home
                </a>
            </div>

        </div>
    </main>

    <x-user-footer />

</body>
</html>