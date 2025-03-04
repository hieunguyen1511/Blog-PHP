<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('language.title_admin_page')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Mobile Menu Button (Fixed Position) -->
    <div class="lg:hidden fixed bottom-4 right-4 z-50">
        <button onclick="toggleSidebar()" class="bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-colors duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-gradient-to-b from-gray-900 to-gray-800 text-white w-64 min-h-screen flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out fixed lg:relative z-40">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">{{__('language.admin_panel')}}</h2>
                </div>
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('dashboard.index') }}" class="flex items-center p-3 rounded-xl transition-all duration-200 hover:bg-gray-700/50 hover:shadow-lg group
                        {{ request()->routeIs('dashboard.index') ? 'bg-gray-700/70 text-green-400' : '' }}">
                            <svg class="w-6 h-6 mr-3 text-gray-400 group-hover:text-blue-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <span class="group-hover:text-blue-400 transition-colors duration-200">{{__('language.sidebar_dashboard')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('post.indexAdmin') }}" class="flex items-center p-3 rounded-xl transition-all duration-200 hover:bg-gray-700/50 hover:shadow-lg group
                        {{ request()->routeIs('post.indexAdmin') ? 'bg-gray-700/70 text-green-400' : '' }}">
                            <svg class="w-6 h-6 mr-3 text-gray-400 group-hover:text-green-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path>
                            </svg>
                            <span class="group-hover:text-green-400 transition-colors duration-200">{{__('language.sidebar_posts')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('category.indexAdmin') }}" class="flex items-center p-3 rounded-xl transition-all duration-200 hover:bg-gray-700/50 hover:shadow-lg group
                        {{ request()->routeIs('category.indexAdmin') ? 'bg-gray-700/70 text-green-400' : '' }}">
                            <svg class="w-6 h-6 mr-3 text-gray-400 group-hover:text-yellow-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="group-hover:text-yellow-400 transition-colors duration-200">{{__('language.sidebar_categories')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.indexAdmin') }}" class="flex items-center p-3 rounded-xl transition-all duration-200 hover:bg-gray-700/50 hover:shadow-lg group
                            {{ request()->routeIs('user.indexAdmin') ? 'bg-gray-700/70 text-green-400' : '' }}">
                            <svg class="w-6 h-6 mr-3 text-gray-400 group-hover:text-purple-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="group-hover:text-purple-400 transition-colors duration-200">{{__('language.sidebar_users')}}</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('setting.index') }}" class="flex items-center p-3 rounded-xl transition-all duration-200 hover:bg-gray-700/50 hover:shadow-lg group
                            {{ request()->routeIs('setting.index') ? 'bg-gray-700/70 text-green-400' : '' }}">
                            <svg class="w-6 h-6 mr-3 text-gray-400 group-hover:text-pink-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="group-hover:text-pink-400 transition-colors duration-200">{{__('language.sidebar_settings')}}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black opacity-50 z-30 hidden lg:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Header -->
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center px-4 lg:px-8 py-4 lg:py-5">
                    <div class="flex items-center flex-1">
                        <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none focus:text-gray-600 transition-colors duration-200 mr-3">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        
                        <!-- Search Bar -->
                        <!-- Ô tìm kiếm -->
                        <div class="relative max-w-md w-full lg:max-w-lg mx-4">
                            <input type="text" id="searchInput" autocomplete="off"
                                   class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                                   placeholder="Search...">
                            <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <!-- Danh sách gợi ý tìm kiếm -->
                            <ul id="searchResults" class="absolute w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-2 hidden text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 z-50"></ul>

                        </div>                        
                     
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Language Selector -->
                        <div class="relative">
                            <select onchange="changeLanguage(this.value)" 
                                    class="appearance-none pl-8 pr-10 py-2 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                                <option value="vi" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                            </select>
                            <div class="absolute left-2 top-2.5 text-gray-400 dark:text-gray-500 pointer-events-none">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                </svg>
                            </div>
                            <div class="absolute right-2 top-2.5 text-gray-400 dark:text-gray-500 pointer-events-none">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Dark Mode Toggle -->
                        {{-- <button onclick="toggleDarkMode()" class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200">
                            <!-- Sun icon -->
                            <svg class="h-6 w-6 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <!-- Moon icon -->
                            <svg class="h-6 w-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button> --}}

                        <!-- Notifications -->
                        {{-- <div class="relative">
                            <button onclick="toggleNotifications()" class="p-2 text-gray-400 hover:text-gray-600 transition-colors duration-200 relative">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span id="notification-dot" class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full hidden"></span>
                            </button>
                            
                            <!-- Notifications Dropdown -->
                            <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <h3 class="text-sm font-semibold text-gray-900">{{__('language.title_notifications')}}</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <div data-id="${id}" class="flex px-4 py-3 hover:bg-gray-50 transition-colors duration-200">
                                        <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=User+1" alt="User 1">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">New user a</p>
                                            <p class="text-xs text-gray-500">2 minutes ago</p>
                                        </div>
                                    </div>
                                </div>
                                <a id="load-more-notifications" href="javascript:void(0)" class="block text-center text-sm text-blue-600 font-medium px-4 py-2 border-t border-gray-100 hover:text-blue-700">
                                    {{__('language.view_more')}}
                                </a>
                            </div>
                        </div> --}}

                        <!-- Admin Profile -->
                        <div class="relative">
                            <button onclick="toggleProfileMenu()" class="flex items-center space-x-3 p-2 rounded-lg transition-colors duration-200 hover:bg-gray-100 group">
                                <?php
                                    $user = (object) session('user');
                                ?>
                                <img class="h-9 w-9 rounded-full object-cover ring-2 ring-blue-500" src="{{ $user->profile_picture ?? asset('default_avatar.jpg') }}" alt="Admin">
                                <div class="text-left hidden sm:block">
                                    <p class="text-sm font-semibold text-blue-100 group-hover:text-blue-700">{{$user->full_name}}</p>

                                    {{-- <p class="text-xs text-gray-500">Super Admin</p> --}}
                                </div>
                                <svg class="w-5 h-5 text-gray-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Profile Dropdown -->
                            <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                <a href="{{route('profile.index', session('userid'))}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Profile
                                    </div>
                                </a>
                                {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Settings
                                    </div>
                                </a> --}}
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-8 overflow-x-hidden">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const searchResults = document.getElementById("searchResults");
            const sidebarItems = [...document.querySelectorAll("#sidebar nav ul li a")];

            searchInput.addEventListener("input", function () {
                const query = this.value.toLowerCase();
                searchResults.innerHTML = "";

                if (query) {
                    const matches = sidebarItems.filter(item => {
                        const text = item.querySelector("span").innerText.toLowerCase();
                        return text.includes(query);
                    });

                    if (matches.length > 0) {
                        matches.forEach(item => {
                            const li = document.createElement("li");
                            li.className = "p-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer rounded";
                            li.textContent = item.querySelector("span").innerText;
                            
                            li.addEventListener("click", () => {
                                item.click();
                                searchResults.classList.add("hidden");
                                searchInput.value = "";
                            });

                            searchResults.appendChild(li);
                        });

                        searchResults.classList.remove("hidden");
                    } else {
                        searchResults.classList.add("hidden");
                    }
                } else {
                    searchResults.classList.add("hidden");
                }
            });

            // Ẩn danh sách khi click ra ngoài
            document.addEventListener("click", (e) => {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add("hidden");
                }
            });
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            
            // Prevent body scroll when sidebar is open
            document.body.classList.toggle('overflow-hidden');
        }

        function toggleProfileMenu() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('hidden');
            
            // Close notifications dropdown if open
            document.getElementById('notifications-dropdown').classList.add('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            // const notificationsButton = document.querySelector('[onclick="toggleNotifications()"]');
            const profileButton = document.querySelector('[onclick="toggleProfileMenu()"]');
            // const notificationsDropdown = document.getElementById('notifications-dropdown');
            const profileDropdown = document.getElementById('profile-dropdown');

            // if (!notificationsButton.contains(event.target) && !notificationsDropdown.contains(event.target)) {
            //     notificationsDropdown.classList.add('hidden');
            // }

            if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        // function toggleDarkMode() {
        //     document.documentElement.classList.toggle('dark');
        //     const isDark = document.documentElement.classList.contains('dark');
        //     localStorage.setItem('darkMode', isDark);
        // }


        function changeLanguage(locale) {
            $.ajax({
                url: `/lang/${locale}`,
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                    language: locale
                },
                success: function (response) {
                    location.reload();
                },
                error: function () {
                    alert("{{ __('language.unknown_error') }}");
                }
            });
        }


        // Initialize dark mode from stored preference
        // if (localStorage.getItem('darkMode') === 'true') {
        //     document.documentElement.classList.add('dark');
        // }

        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const sidebarList = document.getElementById("sidebarList");
            const searchResults = document.getElementById("searchResults");

            // Lấy danh sách item trong sidebar
            const sidebarItems = [...sidebarList.querySelectorAll("li a")].map(item => ({
                text: item.innerText.trim(),
                element: item
            }));

            searchInput.addEventListener("input", function () {
                const query = this.value.toLowerCase();
                searchResults.innerHTML = "";

                if (query) {
                    const matches = sidebarItems.filter(item => item.text.toLowerCase().includes(query));
                    matches.forEach(item => {
                        const li = document.createElement("li");
                        li.className = "p-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer rounded";
                        li.textContent = item.text;
                        li.addEventListener("click", () => {
                            item.element.click();
                            searchResults.classList.add("hidden");
                        });
                        searchResults.appendChild(li);
                    });

                    searchResults.classList.remove("hidden");
                } else {
                    searchResults.classList.add("hidden");
                }
            });

            document.addEventListener("click", (e) => {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add("hidden");
                }
            });
            
        });
        function truncateText(text, maxLength = 100) {
            if (!text) return ''; // Nếu không có dữ liệu, trả về rỗng
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }
        
        function formatNumber(num) {
            if (num >= 1_000_000_000) {
                return (num / 1_000_000_000).toFixed(1) + 'B'; // Tỷ
            } else if (num >= 1_000_000) {
                return (num / 1_000_000).toFixed(1) + 'M'; // Triệu
            } else if (num >= 1_000) {
                return (num / 1_000).toFixed(1) + 'K'; // Nghìn
            }
            return num; // Giữ nguyên nếu nhỏ hơn 1000
        }
    </script>
</body>
</html>
