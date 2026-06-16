<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Question</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<x-user-navbar />

@if(!$mcq)
    <div class="text-center mt-10 text-red-600 font-bold">
        No question found.
    </div>
    @php return; @endphp
@endif

<div class="text-center mt-6 md:mt-8 px-4">
    <h1 class="text-2xl md:text-3xl font-bold text-indigo-600 break-words">
    {{ ucwords(str_replace('-', ' ', Session::get('currentquiz')['quiz_name'] ?? '')) }}
    </h1>

    <p class="text-gray-500 mt-2 text-sm md:text-base">
        Select the correct answer carefully
    </p>
</div>

<div class="max-w-xl mx-auto mt-6 px-4 w-full">

    @php
        $quiz = Session::get('currentquiz');
        $current = $quiz['currentMcq'] ?? 1;
        $total = $quiz['totalMcq'] ?? 1;
        $percent = ($current / $total) * 100;
    @endphp

    <div class="flex justify-between text-sm text-gray-600 mb-2 font-medium">
        <span>Question {{ $current }} / {{ $total }}</span>
        <span>{{ round($percent) }}%</span>
    </div>

    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
        <div class="bg-indigo-600 h-2 transition-all duration-300"
             style="width: {{ $percent }}%"></div>
    </div>
</div>

<div class="flex justify-center mt-6 md:mt-8 px-4 pb-10 flex-1">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg border border-gray-200 p-5 md:p-8">

        <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 leading-relaxed break-words">
            Q.{{ $current }} {{ $mcq->question }}
        </h2>

        <form action="/submit-next/{{ $mcq->id }}" method="POST">
            @csrf

            <div class="space-y-4">

                @php
                    $options = [
                        'A' => $mcq->a,
                        'B' => $mcq->b,
                        'C' => $mcq->c,
                        'D' => $mcq->d,
                    ];
                @endphp

                @foreach($options as $key => $option)

                <label
                    class="flex items-start gap-3 md:gap-4 p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 transition">

                    <input type="radio"
                        name="answer"
                        value="{{ strtolower($key) }}"
                        class="w-5 h-5 accent-indigo-600 mt-1 shrink-0"
                        required>

                    <span class="text-gray-800 font-medium text-sm md:text-base break-words">
                        {{ $option }}
                    </span>

                </label>

                @endforeach

            </div>

            <div class="mt-8 flex justify-end">

                @if(isset($isLast) && $isLast)

                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition">
                        Submit Quiz
                    </button>

                @else

                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition">
                        Submit & Next →
                    </button>

                @endif

            </div>

        </form>

    </div>

</div>

<x-user-footer />

</body>
</html>