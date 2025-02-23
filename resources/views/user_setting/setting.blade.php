@extends('layouts.userLayout')

@section('content')
    <?php #$user = (object) session('user')
    ?>
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Sidebar -->
            <div class="lg:w-1/4 space-y-0.5">
                <!-- User Management Section -->
                <div class="bg-white shadow-sm overflow-hidden border border-gray-100 first:rounded-t-lg last:rounded-b-lg">
                    <div class="p-4 bg-gradient-to-r from-orange-50 to-white border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            User Management
                        </h3>
                    </div>
                    <div class="p-2">
                        <a id="load-content" href="{{ route('edit_profile', ['username' => $user->username]) }}"
                            data-url="{{ route('partial_edit_profile', ['username' => $user->username]) }}" href="#"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 text-gray-700 hover:text-orange-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm">My Profile</span>
                        </a>
                        <a href="/user/settings"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 text-gray-700 hover:text-orange-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm">Settings</span>
                        </a>
                        <a href="/user/following"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 text-gray-700 hover:text-orange-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span class="text-sm">Following</span>
                        </a>
                    </div>
                </div>

                <!-- Post Management Section -->
                <div class="bg-white shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-4 bg-gradient-to-r from-blue-50 to-white border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            Post Management
                        </h3>
                    </div>
                    <div class="p-2">
                        <a href="/posts/create"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            <span class="text-sm">Create New Post</span>
                        </a>
                        <a href="/posts/my-posts"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span class="text-sm">My Posts</span>
                        </a>
                        <a href="/posts/drafts"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            <span class="text-sm">Drafts</span>
                        </a>
                    </div>
                </div>

                <!-- Posts List Section -->
                <div class="bg-white shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-4 bg-gradient-to-r from-green-50 to-white border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            Posts List
                        </h3>
                    </div>
                    <div class="p-2">
                        <a href="/posts/latest"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 hover:text-green-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm">Latest Posts</span>
                        </a>
                        <a href="/posts/popular"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 hover:text-green-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span class="text-sm">Popular Posts</span>
                        </a>
                        <a href="/posts/following"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 hover:text-green-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            <span class="text-sm">Following</span>
                        </a>
                    </div>
                </div>

                <!-- Questions Section -->
                <div class="bg-white shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-4 bg-gradient-to-r from-purple-50 to-white border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Questions
                        </h3>
                    </div>
                    <div class="p-2">
                        <a href="/questions/ask"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-purple-50 text-gray-700 hover:text-purple-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span class="text-sm">Ask Question</span>
                        </a>
                        <a href="/questions/my-questions"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-purple-50 text-gray-700 hover:text-purple-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                            <span class="text-sm">My Questions</span>
                        </a>
                        <a href="/questions/unanswered"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-purple-50 text-gray-700 hover:text-purple-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span class="text-sm">Unanswered</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div id="main-content" class="lg:w-3/4">
                @if (!empty($section))
                    @include('user_setting.' . $section)
                @else
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                        <h1 class="text-2xl font-bold mb-6 text-gray-900 flex items-center">
                            <svg class="w-7 h-7 mr-3 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            User Settings
                        </h1>
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                            <div class="relative h-64">
                                <div class="w-full h-full overflow-hidden">
                                    <img src="{{ $user->cover_photo }}" alt="Cover Photo"
                                        class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex items-start">
                                    <div class="relative">
                                        <img class="h-24 w-24 rounded-full border-4 border-white bg-white"
                                            src="{{ $user->profile_picture }}" alt="Profile">
                                    </div>
                                    <div class="ml-4">
                                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->full_name }}</h1>
                                        <p class="text-gray-600 mt-1">{{ '@' . $user->username }}</p>

                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-gray-100 px-6 py-4">
                                <div class="flex space-x-8">
                                    <div class="flex-1">
                                        <div class="text-2xl font-bold text-gray-900">{{ $user->posts->count() }}</div>
                                        <div class="text-sm text-gray-500">Posts</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-2xl font-bold text-gray-900">{{ $user->posts->sum('view_count') }}
                                        </div>
                                        <div class="text-sm text-gray-500">Views</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-2xl font-bold text-gray-900">{{ $user->posts->sum('like_count') }}
                                        </div>
                                        <div class="text-sm text-gray-500">Likes</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                @endif

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#load-content').on('click', function(e) {
                e.preventDefault();
                let url_load = $(this).data('url');
                let url_show = $(this).attr('href');
                $.ajax({
                    url: url_load,
                    type: 'GET',
                    success: function(response) {
                        window.history.pushState({
                            path: url_show
                        }, '', url_show);
                        $('#main-content').html(response);
                    }
                });
            });
        });
    </script>
@endsection
