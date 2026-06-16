<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result | Quiz Master</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

<x-user-navbar />

<div class="max-w-5xl mx-auto px-4 py-8 flex-1">

    <!-- Result Summary -->
    <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden mb-8">

        <div class="bg-indigo-600 text-white p-8 text-center">

            <h1 class="text-3xl md:text-4xl font-bold">
                🎉 Quiz Completed
            </h1>

            <p class="mt-3 text-indigo-100">
                Here is your performance summary
            </p>

        </div>

        <div class="p-8 text-center">

            <div class="inline-flex flex-col items-center">

                <div class="text-5xl font-bold text-indigo-600">
                    {{ $score }}
                </div>

                <div class="text-gray-500 mt-1">
                    out of {{ $total }}
                </div>

            </div>

            <div class="mt-4">

                <span class="inline-block px-5 py-2 rounded-full text-sm font-semibold
                    {{ $percentage >= 80 ? 'bg-green-100 text-green-700' :
                       ($percentage >= 50 ? 'bg-yellow-100 text-yellow-700' :
                       'bg-red-100 text-red-700') }}">
                    {{ $percentage }}%
                </span>

            </div>

            @if(isset($percentage) && $percentage >= 70 && isset($result))

            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">

                <a href="{{ url('certificate/view/'.$result->id) }}"
                   class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                    View Certificate
                </a>

                <a href="{{ url('certificate/download/'.$result->id) }}"
                   class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                    Download Certificate
                </a>

            </div>

            @endif

        </div>

    </div>

    <!-- Questions Review -->
    <div class="space-y-6">

        @foreach($results as $index => $res)

        @php
            $selectedOption = $res->mcq->{$res->select_ans};
            $correctOption = $res->mcq->{$res->mcq->correct_ans};
        @endphp

        <div class="bg-white rounded-2xl shadow-md border overflow-hidden">

            <div class="px-6 py-4 border-b
                {{ $res->is_correct
                    ? 'bg-green-50 border-green-200'
                    : 'bg-red-50 border-red-200' }}">

                <div class="flex justify-between items-center">

                    <h3 class="font-bold text-lg text-gray-800">
                        Question {{ $index + 1 }}
                    </h3>

                    @if($res->is_correct)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            ✅ Correct
                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                            ❌ Wrong
                        </span>

                    @endif

                </div>

            </div>

            <div class="p-6">

                <h4 class="font-semibold text-gray-900 mb-4">
                    {{ $res->mcq->question }}
                </h4>

                <div class="space-y-4">

                    <div>
                        <p class="text-sm text-gray-500 mb-1">
                            Your Answer
                        </p>

                        <div class="font-medium
                            {{ $res->is_correct ? 'text-green-700' : 'text-red-700' }}">
                            {{ strtoupper($res->select_ans) }}) {{ $selectedOption }}
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 mb-1">
                            Correct Answer
                        </p>

                        <div class="font-medium text-green-700">
                            {{ strtoupper($res->mcq->correct_ans) }}) {{ $correctOption }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- Action Buttons -->
    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">

        <a href="/"
           class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition text-center">
            Go Home
        </a>

        <a href="/my-results"
           class="bg-gray-700 text-white px-8 py-3 rounded-xl font-semibold hover:bg-gray-800 transition text-center">
            My Results
        </a>

    </div>

</div>

<x-user-footer />

</body>
</html>