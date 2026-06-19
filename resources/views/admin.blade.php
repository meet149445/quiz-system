<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Quiz System</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

<x-navbar name={{$name}}></x-navbar>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6">

    <div class="bg-white shadow-sm rounded-2xl border border-gray-200 p-5 sm:p-8 mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-indigo-600">
            Welcome, {{ $name }}
        </h1>

        <p class="text-gray-500 mt-2 text-sm sm:text-base">
            Manage users and monitor platform activity.
        </p>
    </div>

    <div class="bg-white shadow-sm rounded-2xl border border-gray-200 p-4 sm:p-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">
                    Registered Users
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Total users on the platform
                </p>
            </div>

        </div>

        <div class="overflow-x-auto rounded-xl border border-gray-200">

            <table class="w-full min-w-[650px]">

                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="p-3 text-left">S No.</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Joined At</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($users as $user)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-3">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>

                        <td class="p-3 font-medium text-gray-800">
                            {{ $user->name }}
                        </td>

                        <td class="p-3 text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="p-3 text-gray-600 whitespace-nowrap">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            No users found
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6 overflow-x-auto">
            {{ $users->links() }}
        </div>

    </div>

</div>


</body>
</html>