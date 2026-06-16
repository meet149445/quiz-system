<!DOCTYPE html>
<html>
<head>
    <title>My Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<x-user-navbar/>

<div class="max-w-5xl mx-auto w-full px-4 py-8 flex-1">

    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg">

        <h1 class="text-2xl md:text-3xl font-bold text-indigo-600 mb-6">
            My Quiz Results
        </h1>

<div class="rounded-xl border border-gray-200 overflow-hidden">

    {{-- Desktop Table --}}
    <div class="hidden md:block overflow-x-auto">

        <table class="w-full">

            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th class="p-3 text-left">Quiz Name</th>
                    <th class="p-3 text-center">Score</th>
                    <th class="p-3 text-center">Percentage</th>
                    <th class="p-3 text-center">Date</th>
                </tr>
            </thead>

            <tbody>

                @forelse($results as $result)

                @php
                    $percentage = $result->total > 0
                        ? round(($result->score / $result->total) * 100)
                        : 0;
                @endphp

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3 font-medium">
                        {{ $result->quiz ? $result->quiz->name : 'Quiz Deleted' }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $result->score }}/{{ $result->total }}
                    </td>

                    <td class="p-3 text-center">
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $percentage >= 80 ? 'bg-green-100 text-green-700' :
                           ($percentage >= 50 ? 'bg-yellow-100 text-yellow-700' :
                           'bg-red-100 text-red-700') }}">
                            {{ $percentage }}%
                        </span>
                    </td>

                    <td class="p-3 text-center">
                        {{ $result->created_at->format('d M Y') }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center py-8 text-gray-500">
                        No quiz results found.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden p-4 space-y-4">

        @forelse($results as $result)

        @php
            $percentage = $result->total > 0
                ? round(($result->score / $result->total) * 100)
                : 0;
        @endphp

        <div class="border rounded-2xl p-4 shadow-sm">

            <h3 class="font-bold text-gray-800 text-lg">
                {{ $result->quiz ? $result->quiz->name : 'Quiz Deleted' }}
            </h3>

            <div class="mt-3 space-y-2 text-sm">

                <p>
                    <span class="font-semibold">Score:</span>
                    {{ $result->score }}/{{ $result->total }}
                </p>

                <p>
                    <span class="font-semibold">Date:</span>
                    {{ $result->created_at->format('d M Y') }}
                </p>

                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                {{ $percentage >= 80 ? 'bg-green-100 text-green-700' :
                   ($percentage >= 50 ? 'bg-yellow-100 text-yellow-700' :
                   'bg-red-100 text-red-700') }}">
                    {{ $percentage }}%
                </span>

            </div>

        </div>

        @empty

        <div class="text-center py-8 text-gray-500">
            No quiz results found.
        </div>

        @endforelse

    </div>

</div>
```


        <div class="mt-6">
            {{ $results->links() }}
        </div>

    </div>

</div>

<x-user-footer/>

</body>
</html>