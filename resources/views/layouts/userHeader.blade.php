<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-4">
                <!-- Blog Icon and Name -->
                <a href="/" class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M5 3a1 1 0 000 2c5.523 0 10 4.477 10 10a1 1 0 102 0C17 8.373 11.627 3 5 3z" />
                        <path d="M4 9a1 1 0 011-1 7 7 0 017 7 1 1 0 11-2 0 5 5 0 00-5-5 1 1 0 01-1-1z" />
                    </svg>
                    <span class="text-xl font-bold text-gray-900">Blog Name</span>
                </a>

                <!-- Navigation (hidden on mobile) -->
                <nav class="hidden md:flex space-x-4">
                    <a href="/post" class="text-gray-500 hover:text-gray-900">Post</a>
                    <div class="relative group" id="categories-dropdown">
                        <a href="/categories" class="text-gray-500 hover:text-gray-900">Categories</a>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
                            <a href="/category/technology"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Technology</a>
                            <a href="/category/lifestyle"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lifestyle</a>
                            <a href="/category/travel"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Travel</a>
                            <a href="/category/food"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Food</a>
                            <a href="/category/fashion"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Fashion</a>
                            <a href="/category/sports"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sports</a>
                            <a href="/category/health"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Health</a>
                            <a href="/category/business"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Business</a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Search Field (hidden on mobile) -->
                <div class="hidden md:block">
                    <input type="text" placeholder="Search..."
                        class="w-64 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Notification Container -->



                {{-- <!-- Notification Icon -->
                <button class="relative p-1 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" id="notification-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                </button>

                <!-- Notification Popup -->
                <div class="absolute right-10 top-10 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-20 hidden" id="notification-popup">
                    <div class="py-2">
                        <h3 class="text-lg font-semibold px-4 py-2 border-b">Notifications</h3>
                        <div class="max-h-64 overflow-y-auto">
                            <a href="#" class="block px-4 py-3 hover:bg-gray-100 transition ease-in-out duration-150">
                                <p class="text-sm font-medium text-gray-900">New comment on your post</p>
                                <p class="text-xs text-gray-500">1 hour ago</p>
                            </a>
                            <a href="#" class="block px-4 py-3 hover:bg-gray-100 transition ease-in-out duration-150">
                                <p class="text-sm font-medium text-gray-900">You have a new follower</p>
                                <p class="text-xs text-gray-500">3 hours ago</p>
                            </a>
                        </div>
                        <a href="/notifications" class="block bg-gray-50 text-sm font-medium text-center text-blue-600 py-2">View all</a>
                    </div>
                </div> --}}

                <!-- Login/Register Buttons (hidden on mobile) -->
                @if (session('userid') == null)
                    <div class="hidden md:flex space-x-2">

                        <button
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">Login</button>
                        <button
                            class="px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">Register</button>
                    </div>
                @else
                    <div class="relative inline-block">
                        <!-- Notification Icon -->
                        <button
                            class="relative p-1 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="notification-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span
                                class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                        </button>

                        <!-- Notification Popup -->
                        <div class="absolute left-1/2 top-full transform -translate-x-1/2 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-20 hidden"
                            id="notification-popup">
                            <div class="py-2">
                                <h3 class="text-lg font-semibold px-4 py-2 border-b">Notifications</h3>
                                <div class="max-h-64 overflow-y-auto">
                                    <a href="#"
                                        class="block px-4 py-3 hover:bg-gray-100 transition ease-in-out duration-150">
                                        <p class="text-sm font-medium text-gray-900">New comment on your post</p>
                                        <p class="text-xs text-gray-500">1 hour ago</p>
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-3 hover:bg-gray-100 transition ease-in-out duration-150">
                                        <p class="text-sm font-medium text-gray-900">You have a new follower</p>
                                        <p class="text-xs text-gray-500">3 hours ago</p>
                                    </a>
                                </div>
                                <a href="/notifications"
                                    class="block bg-gray-50 text-sm font-medium text-center text-blue-600 py-2">View
                                    all</a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-2">
                        <img class="h-8 w-8 rounded-full"
                            src="https://as1.ftcdn.net/v2/jpg/00/65/75/68/1000_F_65756860_GUZwzOKNMUU3HldFoIA44qss7ZIrCG8I.jpg"
                            alt="User avatar" />
                        <div class="relative inline-block">
                            <button id="profile-button" class="text-sm font-medium text-gray-700">Hieu Nguyen</button>
                            <div class="absolute left-1/2 top-full transform -translate-x-1/2 mt-2 w-40 bg-white rounded-md shadow-lg overflow-hidden z-20 hidden"
                                id="profile-popup">
                                <div class="py-2">
                                    {{-- <h3 class="text-lg font-semibold px-4 py-2 border-b">Profile</h3> --}}
                                    <div class="max-h-64 overflow-y-auto">
                                        <a href="#"
                                            class="block px-4 py-3 hover:bg-gray-100 transition ease-in-out duration-150">
                                            <p class="text-sm font-medium text-gray-900">New Post</p>
                                        </a>
                                        <a href="#"
                                            class="block px-4 py-3 hover:bg-gray-100 transition ease-in-out duration-150">
                                            <p class="text-sm font-medium text-gray-900">Info</p>
                                        </a>
                                        <a href="#"
                                            class="block px-4 py-3 hover:bg-gray-100 transition ease-in-out duration-150">
                                            <p class="text-sm font-medium text-gray-900">Change Password</p>
                                        </a>

                                    </div>
                                    <a href="{{ route('logout') }}"
                                        class="block bg-gray-50 text-sm font-medium text-center text-red-600 py-2">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <!-- Mobile menu button -->
                <div class="md:hidden">

                    <button id="mobile-menu-button"
                        class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu (hidden by default) -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="/post"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Post</a>
                <a href="/categories"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Categories</a>
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Login</a>
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Register</a>
            </div>
            <div class="px-2 pt-2 pb-3">
                <input type="text" placeholder="Search..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </div>
</header>
