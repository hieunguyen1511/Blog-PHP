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
                        <a href="{{ route('setting') }}"
                            class="{{ request()->routeIs('setting') ? 'bg-orange-50 text-orange-600' : 'text-gray-700 hover:bg-orange-50 hover:text-orange-600' }} flex items-center px-3 py-2 rounded-md hover:bg-orange-50 text-gray-700 hover:text-orange-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm">Settings</span>
                        </a>
                        <a href="{{ route('edit_profile') }}"
                            class="{{ request()->routeIs('edit_profile') ? 'bg-orange-50 text-orange-600' : 'text-gray-700 hover:bg-orange-50 hover:text-orange-600' }} flex items-center px-3 py-2 rounded-md hover:bg-orange-50 text-gray-700  transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm">Edit Profile</span>
                        </a>

                        <a href="{{ route('change_password') }}"
                            class="{{ request()->routeIs('change_password') ? 'bg-orange-50 text-orange-600' : 'text-gray-700 hover:bg-orange-50 hover:text-orange-600' }} flex items-center px-3 py-2 rounded-md hover:bg-orange-50 text-gray-700  transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                </path>
                            </svg>
                            <span class="text-sm">Change Password</span>
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
                        <a href="{{ route('create_post') }}"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            <span class="text-sm">Create New Post</span>
                        </a>
                        <a href="{{route('my_post')}}"
                            class="{{ request()->routeIs('my_post') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} flex items-center px-3 py-2 rounded-md hover:bg-blue-50  transition-colors duration-200">
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
                {{-- <div class="bg-white shadow-sm overflow-hidden border border-gray-100">
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
                </div> --}}

                <!-- Questions Section -->
                {{-- <div class="bg-white shadow-sm overflow-hidden border border-gray-100">
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
                            <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M16 18H8l2.5-6 2 4 1.5-2 2 4Zm-1-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 18h8l-2-4-1.5 2-2-4L8 18Zm7-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                            </svg>

                            <span class="text-sm">Media Resource</span>
                        </a>
                    </div>
                </div> --}}
                <!-- Media Resource Section -->
                <div class="bg-white shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-4 bg-gradient-to-r from-purple-50 to-white border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M16 18H8l2.5-6 2 4 1.5-2 2 4Zm-1-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 18h8l-2-4-1.5 2-2-4L8 18Zm7-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                            </svg>
                            {{ __('language.setting_media_resource') }}
                        </h3>
                    </div>
                    <div class="p-2">
                        <a href="{{route('media_resource')}}"
                            class="{{ request()->routeIs('media_resource') ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-orange-50 hover:text-purple-600' }} flex items-center px-3 py-2 rounded-md hover:bg-purple-50 text-gray-700  transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M16 18H8l2.5-6 2 4 1.5-2 2 4Zm-1-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 18h8l-2-4-1.5 2-2-4L8 18Zm7-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                            </svg>

                            <span class="text-sm">Media Resource</span>
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
                                        <div class="text-2xl font-bold text-gray-900">
                                            {{ $user->posts->sum('view_count') }}
                                        </div>
                                        <div class="text-sm text-gray-500">Views</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-2xl font-bold text-gray-900">
                                            {{ $user->posts->sum('like_count') }}
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
        // $(document).ready(function() {
        //     $('#load-content').on('click', function(e) {
        //         e.preventDefault();
        //         let url_load = $(this).data('url');
        //         let url_show = $(this).attr('href');
        //         $.ajax({
        //             url: url_load,
        //             type: 'GET',
        //             success: function(response) {
        //                 window.history.pushState({
        //                     path: url_show
        //                 }, '', url_show);
        //                 $('#main-content').html(response);
        //             }
        //         });
        //     });
        // });


        //     document.addEventListener("DOMContentLoaded", function () {
        //     let currentUrl = window.location.pathname;
        //     let menuLinks = document.querySelectorAll("#load-content");

        //     menuLinks.forEach(link => {
        //         let linkUrl = link.getAttribute("data-url"); // Lấy giá trị của data-url
        //         console.log(linkUrl,"=", currentUrl);
        //         if (linkUrl === currentUrl) {
        //             link.classList.add("bg-orange-50", "text-orange-600");
        //         } else {
        //             link.classList.add("text-gray-700", "hover:bg-orange-50", "hover:text-orange-600");
        //         }
        //     });
        // });
    </script>
@endsection
