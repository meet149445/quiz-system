<nav class="bg-white shadow-md px-4 py-3">

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3">

        <!-- Logo -->
        <div class="text-xl text-gray-600 hover:text-blue-500 cursor-pointer text-center md:text-left">
            Quiz System
        </div>

        <!-- Menu -->
        <div class="flex flex-wrap justify-center md:justify-end items-center gap-3 md:gap-5 text-sm md:text-base">

            <a href="/dashboard" class="text-gray-500 hover:text-blue-500">
                Dashboard
            </a>

            <a href="/admin-categories" class="text-gray-500 hover:text-blue-500">
                Categories
            </a>

            <a href="/add-quiz" class="text-gray-500 hover:text-blue-500">
                Quiz
            </a>

            <a href="" class="text-gray-500 hover:text-blue-500">
                Welcome {{$name}}
            </a>

            <a href="/admin-logout" class="text-gray-500 hover:text-blue-500">
                Logout
            </a>

        </div>

    </div>

</nav>