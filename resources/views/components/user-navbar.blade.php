<nav class="bg-white shadow-md px-4 py-3 relative">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3">

        <div class="text-xl text-gray-600 hover:text-blue-500 cursor-pointer text-center md:text-left">
            Quiz System
        </div>

        <div class="flex flex-wrap justify-center md:justify-end items-center gap-3 md:gap-5 text-sm md:text-base">

            <a href="/" class="text-gray-500 hover:text-blue-500">
                Home
            </a>

            <a href="/categories-list" class="text-gray-500 hover:text-blue-500">
                Categories
            </a>

            <a href="/blog" class="text-gray-500 hover:text-blue-500">
                Blog
            </a>

            @if(session('user'))

                <a href="/profile"
   class="text-gray-500 hover:text-blue-500 max-w-[140px] truncate">
    {{ session('user')->name }}
</a>    

                <a href="/my-results" class="text-gray-500 hover:text-blue-500">
                    My Results
                </a>

                <button
                    onclick="openLogoutModal()"
                    class="text-gray-500 hover:text-blue-500">
                    Logout
                </button>

            @else

                <a href="/user-login" class="text-gray-500 hover:text-blue-500">
                    Login
                </a>

                <a href="/user-signup" class="text-gray-500 hover:text-blue-500">
                    Signup
                </a>

                <a href="/admin-login"
                   class="bg-gray-800 text-white px-3 py-2 rounded hover:bg-black">
                    Admin
                </a>

            @endif

        </div>
    </div>
</nav>

<div id="logoutModal"
     class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">

    <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-6 text-center">

        <div class="w-14 h-14 mx-auto bg-red-100 text-red-600 flex items-center justify-center rounded-full text-2xl mb-4">
            ⚠️
        </div>

        <h2 class="text-lg font-semibold text-gray-900">
            Logout Confirmation
        </h2>

        <p class="text-sm text-gray-500 mt-2">
            Are you sure you want to logout?
        </p>

        <div class="flex flex-col sm:flex-row gap-3 mt-6">

            <button onclick="closeLogoutModal()"
                class="w-full sm:w-1/2 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium">
                Cancel
            </button>

            <a href="/user-logout"
               class="w-full sm:w-1/2 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white font-medium text-center">
                Logout
            </a>

        </div>

    </div>
</div>

<script>
function openLogoutModal() {
    document.getElementById('logoutModal').classList.remove('hidden');
}

function closeLogoutModal() {
    document.getElementById('logoutModal').classList.add('hidden');
}

document.getElementById('logoutModal').addEventListener('click', function(e){
    if(e.target === this){
        closeLogoutModal();
    }
});
</script>