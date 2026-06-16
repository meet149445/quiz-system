<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<x-user-navbar/>

<div class="max-w-4xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-bold text-gray-900">Blog</h1>
        <p class="text-gray-500 mt-2">Tips, guides & insights for learners</p>
    </div>

    <!-- Blog Cards -->
    <div class="space-y-8">

        @foreach($blogs as $blog)

            <a href="/blog/{{ $blog->id }}"
               class="block bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">

                <div class="p-6">

                    <!-- Meta -->
                    <div class="flex items-center text-xs text-gray-500 mb-3">
                        <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</span>
                        <span class="mx-2">•</span>
                        <span class="bg-gray-100 px-2 py-1 rounded-full">Article</span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-2xl font-bold text-gray-900 hover:text-indigo-600 transition">
                        {{ $blog->title }}
                    </h2>

                    <!-- Preview -->
                    <p class="text-gray-600 mt-3 leading-relaxed line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 180) }}
                    </p>

                    <!-- Read more -->
                    <div class="mt-5 text-indigo-600 font-medium">
                        Read more →
                    </div>

                </div>

            </a>

        @endforeach

    </div>

</div>
<x-user-footer />

</body>
</html>