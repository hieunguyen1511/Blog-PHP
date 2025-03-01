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
                    <span class="text-xl font-bold text-gray-900">{{ env('APP_NAME') }}</span>
                </a>

                <!-- Navigation (hidden on mobile) -->
                <nav class="hidden md:flex space-x-4">
                    {{-- <a href="/post" class="text-gray-500 hover:text-gray-900 transition-colors duration-200">Post</a> --}}
                    <div class="relative group">
                        <button
                            class="text-gray-500 hover:text-gray-900 flex items-center transition-colors duration-200">
                            Categories
                            <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top scale-95 group-hover:scale-100 z-50">
                            <div class="py-1">
                                @foreach ($categories as $item)
                                    <a href="/category/{{ $item->name }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                        {{ $item->name }}
                                    </a>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Search Field (hidden on mobile) -->
                <div class="hidden md:block relative">
                    <form method="post" action="{{route('search')}}">
                        @csrf
                        <input type="text" name="search" id="search-input" placeholder="{{ __('language.header_Placeholder_search') }}"
                        class="w-96 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </form>
                    

                    <!-- Search Results Dropdown -->
                    <div id="search-results"
                        class="absolute left-0 mt-2 w-full bg-white rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform origin-top scale-95 z-50">
                        <div class="py-2">
                            <!-- Posts Section -->
                            <div id="related-posts" class="border-b border-gray-100">
                                <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">{{__('language.header_related_post')}}</h3>
                                <div class="max-h-48 overflow-y-auto" id="posts-container">
                                    <!-- Posts will be dynamically inserted here -->
                                </div>
                            </div>

                            <!-- Categories Section -->
                            <div id="related-categories">
                                <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">{{__('language.header_related_category')}}
                                </h3>
                                <div class="max-h-32 overflow-y-auto" id="categories-container">
                                    <!-- Categories will be dynamically inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Language Switcher -->
                <div class="hidden md:block">
                    <select onchange="window.location.href=this.value"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="{{ url('/lang/en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                            English</option>
                        <option value="{{ url('/lang/vi') }}" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Tiếng
                            Việt</option>
                    </select>
                </div>

                <!-- Notification Container -->


                <!-- Login/Register Buttons (hidden on mobile) -->
                @if (session('userid') == null)
                    <div class="hidden md:flex space-x-2">

                        <a href="{{ route('login') }}"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ __('language.header_login') }}</a>
                        <a href="{{ route('register') }}"
                            class="px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ __('language.header_register') }}</a>
                    </div>
                @else
                    <?php
                    $user = (object) session('user');
                    ?>
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
                                <h3 class="text-lg font-semibold px-4 py-2 border-b">
                                    {{ __('language.header_notifications') }}</h3>
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
                                    class="block bg-gray-50 text-sm font-medium text-center text-blue-600 py-2">{{ __('language.header_notifications_all') }}</a>
                            </div>
                        </div>
                    </div>
                    <div id="profile-button" class="hidden md:flex items-center space-x-2">
                        <img class="h-8 w-8 rounded-full" src="{{ $user->profile_picture }}" alt="User avatar" />
                        <div class="relative inline-block">
                            <button class="text-sm font-medium text-gray-700">{{ $user->full_name }}</button>
                            <div class="absolute left-1/2 top-full transform -translate-x-1/2 mt-2 w-56 bg-white rounded-lg shadow-lg overflow-hidden z-20 hidden"
                                id="profile-popup">
                                <div class="py-2">
                                    <!-- User Info Section -->
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <p class="text-sm font-semibold text-gray-900">{{ $user->full_name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                                    </div>

                                    <!-- Menu Items -->
                                    <div class="py-1">
                                        <a href="{{ route('create_post') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            {{ __('language.header_user_new_post') }}
                                        </a>
                                        <a href="{{route('get-profile',['username'=>$user->username])}}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            {{ __('language.header_user_profile') }}
                                        </a>
                                        <a href="{{route('setting')}}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ __('language.header_user_setting') }}
                                        </a>
                                        <a href="{{ route('change_password') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                                </path>
                                            </svg>
                                            {{ __('language.header_user_change_password') }}
                                        </a>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t border-gray-100"></div>

                                    <!-- Logout Button -->
                                    <a href="{{ route('logout') }}"
                                        class="flex items-center justify-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        {{ __('language.header_user_logout') }}
                                    </a>
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
                <!-- Search container for mobile -->
                <div class="relative mb-3">
                    <input type="text" id="mobile-search-input"
                        placeholder="{{ __('language.header_Placeholder_search') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <!-- Mobile Search Results Dropdown -->
                    <div id="mobile-search-results"
                        class="absolute left-0 right-0 mt-2 bg-white rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform origin-top scale-95 z-50">
                        <div class="py-2">
                            <!-- Posts Section -->
                            <div id="mobile-related-posts" class="border-b border-gray-100">
                                <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Related Posts</h3>
                                <div class="max-h-48 overflow-y-auto" id="mobile-posts-container">
                                    <!-- Posts will be dynamically inserted here -->
                                </div>
                            </div>

                            <!-- Categories Section -->
                            <div id="mobile-related-categories">
                                <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Related Categories
                                </h3>
                                <div class="max-h-32 overflow-y-auto" id="mobile-categories-container">
                                    <!-- Categories will be dynamically inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="/post"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Post</a>
                <a href="/categories"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Categories</a>
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Login</a>
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Register</a>
                <select onchange="window.location.href=this.value"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-2">
                    <option value="{{ url('locale/en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English
                    </option>
                    <option value="{{ url('locale/vi') }}" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Tiếng
                        Việt</option>
                </select>
            </div>
        </div>
    </div>
</header>

<script>
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 1) {
                document.getElementById('search-results').classList.remove('opacity-0', 'invisible',
                    'scale-95');
                document.getElementById('search-results').classList.add('opacity-100', 'visible',
                    'scale-100');
                const searchInput = document.getElementById('search-input');
                const searchResults = document.getElementById('search-results');
                $.ajax({
                    url: `/api/search/${query}`,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === '200') {
                            document.getElementById('posts-container').innerHTML = response
                                .posts.map(
                                    post => ` <a href="/post/${post.link}" class="block px-4 py-2 hover:bg-blue-50">
                                                <div class="text-sm font-medium text-gray-900">${post.title}</div>
                                                <div class="text-xs text-gray-500">${truncateText(post.description,20)}</div>
                                            </a>`
                                ).join('');
                            document.getElementById('categories-container').innerHTML =
                                response.categories.map(
                                    category => `
                                                <a href="/category/${category.name}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                                    ${category.name}
                                                </a>`
                                ).join('');

                        } else {

                        }
                    }
                });
            } else {
                document.getElementById('search-results').classList.remove('opacity-100', 'visible',
                    'scale-100');
                document.getElementById('search-results').classList.add('opacity-0', 'invisible',
                    'scale-95');
            }
        });
        $('#mobile-search-input').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 1) {
                document.getElementById('mobile-search-results').classList.remove('opacity-0',
                    'invisible', 'scale-95');
                document.getElementById('mobile-search-results').classList.add('opacity-100', 'visible',
                    'scale-100');
                const mobileSearchInput = document.getElementById('mobile-search-input');
                const mobileSearchResults = document.getElementById('mobile-search-results');
                $.ajax({
                    url: `/api/search/${query}`,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === '200') {
                            document.getElementById('mobile-posts-container').innerHTML = response
                                .posts.map(
                                    post => ` <a href="/post/${post.link}" class="block px-4 py-2 hover:bg-blue-50">
                                                <div class="text-sm font-medium text-gray-900">${post.title}</div>
                                                <div class="text-xs text-gray-500">${truncateText(post.description,20)}</div>
                                            </a>`
                                ).join('');
                            document.getElementById('mobile-categories-container').innerHTML =
                                response.categories.map(
                                    category => `
                                                <a href="/category/${category.name}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                                    ${category.name}
                                                </a>`
                                ).join('');
                        } else {

                        }
                    }
                });
            } else {
                document.getElementById('mobile-search-results').classList.remove('opacity-100',
                    'visible', 'scale-100');
                document.getElementById('mobile-search-results').classList.add('opacity-0', 'invisible',
                    'scale-95');
            }
        });
    });


    function truncateText(text, wordLimit) {
        let words = text.split(' ');
        return words.length > wordLimit ? words.slice(0, wordLimit).join(' ') + '...' : text;
    }
</script>
