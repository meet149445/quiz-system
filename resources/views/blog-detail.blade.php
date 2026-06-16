<!DOCTYPE html>
<html>
<head>
    <title>{{ $blog->title }} | Quiz System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

<x-user-navbar/>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-6 sm:py-10">

    <a href="/blog"
       class="inline-flex items-center text-indigo-600 text-sm font-medium hover:text-indigo-700">
        ← Back to Blogs
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 sm:p-8 mt-4">

        <div class="mb-5">

            <span class="inline-block bg-indigo-50 text-indigo-600 text-xs font-semibold px-3 py-1 rounded-full">
                Article
            </span>

            <div class="text-sm text-gray-500 mt-3">
                {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
            </div>

        </div>

        <h1 class="text-2xl sm:text-4xl font-bold text-gray-900 leading-tight">
            {{ $blog->title }}
        </h1>

        <hr class="my-6 border-gray-200">

        <div class="prose prose-sm sm:prose-base max-w-none text-gray-700 leading-relaxed">
            {!! $blog->content !!}
        </div>

    </div>

</div>
<x-user-footer />
</body>
</html>