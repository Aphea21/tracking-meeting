<aside class="w-64 bg-gray-900 text-white flex flex-col">
    <!-- Logo Section -->
    <div class="p-4 border-b border-gray-800 flex-shrink-0">
        <div class="flex items-center justify-between">
            <img src="https://tailwindflex.com/images/logo.svg" alt="Logo" class="h-8 w-auto">
            <span class="text-xl font-bold">Wen</span>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="p-4 flex-shrink-0">
        <div class="relative">
            <input type="text"
                class="w-full bg-gray-800 text-white rounded-md pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Search...">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Navigation -->
<nav class="flex-1 px-3 py-4 overflow-y-auto space-y-4 bg-gray-900 text-gray-200">
    <!-- DASHBOARD -->
    <a href="{{ route('admin.dashboard') }}"
       class="flex items-center px-4 py-2 text-sm font-medium rounded-lg bg-gray-800 hover:bg-gray-700 transition">
        🏠 <span class="ml-3">Dashboard</span>
    </a>

    <!-- MEETING MANAGEMENT -->
    <div>
        <p class="px-4 py-2 text-xs uppercase tracking-wider text-gray-400">Meeting Management</p>
        <div class="pl-6 space-y-1">
            <a href="{{ route('agendas.index') }}" class="block py-2 text-sm hover:text-amber-400">🗓️ Agendas</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">🧾 Concerns / Issues</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">💬 Comments & Discussions</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">📎 Attachments</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">📦 Archived Agendas</a>
        </div>
    </div>

    <!-- REPORTS -->
    <div>
        <p class="px-4 py-2 text-xs uppercase tracking-wider text-gray-400">Reports & Tracking</p>
        <div class="pl-6 space-y-1">
            <a href="#" class="block py-2 text-sm hover:text-amber-400">📊 Meeting Reports</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">📅 Timeline / Calendar View</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">🕓 Activity Logs</a>
        </div>
    </div>

    <!-- USER MANAGEMENT -->
    <div>
        <p class="px-4 py-2 text-xs uppercase tracking-wider text-gray-400">User & Access</p>
        <div class="pl-6 space-y-1">
            <a href="#" class="block py-2 text-sm hover:text-amber-400">👥 Participants</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">🧑‍💼 Admins & Staff</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">⚙️ Roles & Permissions</a>
        </div>
    </div>

    <!-- SETTINGS -->
    <div>
        <p class="px-4 py-2 text-xs uppercase tracking-wider text-gray-400">System</p>
        <div class="pl-6 space-y-1">
            <a href="#" class="block py-2 text-sm hover:text-amber-400">🔧 Settings</a>
            <a href="#" class="block py-2 text-sm hover:text-amber-400">📤 Backups</a>
        </div>
    </div>
</nav>


    <!-- User Profile -->
    <div class="p-4 border-t border-gray-800 flex-shrink-0">
        <div class="flex items-center">
            <img class="h-8 w-8 rounded-full"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e"
                alt="User">
            <div class="ml-3">
                <p class="text-sm font-medium text-white">Tom Cook</p>
                <p class="text-xs text-gray-400">Bookkeeper</p>
            </div>
        </div>
    </div>
</aside>


        
            <script>
                function toggleProfileDropdown() {
                    const dropdown = document.getElementById('profile-dropdown');
                    const arrow = document.getElementById('profile-arrow');

                    dropdown.classList.toggle('hidden');
                    arrow.classList.toggle('rotate-180');
                }

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    const profileSection = event.target.closest('.relative');
                    const dropdown = document.getElementById('profile-dropdown');

                    if (!profileSection && !dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden');
                        document.getElementById('profile-arrow').classList.remove('rotate-180');
                    }
                });
    
            // Dropdown functionality
            document.querySelectorAll('button[aria-controls]').forEach(button => {
                button.addEventListener('click', () => {
                    const isExpanded = button.getAttribute('aria-expanded') === 'true';
                    const dropdownContent = document.getElementById(button.getAttribute('aria-controls'));

                    button.setAttribute('aria-expanded', !isExpanded);
                    dropdownContent.classList.toggle('hidden');
                    button.querySelector('svg:last-child').classList.toggle('rotate-180');
                });
            });

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id + '-dropdown');
            const arrow = document.getElementById(id + '-arrow');

            dropdown.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }
    </script>