@extends('layouts.userLayout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
        <div class="relative h-10">
            <div class="w-full h-full overflow-hidden">
                <img src="https://images.unsplash.com/photo-1707343843437-caacff5cfa74" 
                     alt="Cover Photo" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
        </div>
        <div class="px-6 py-4">
            <div class="flex items-start">
                <div class="relative">
                    <img class="h-24 w-24 rounded-full border-4 border-white bg-white" src="https://ui-avatars.com/api/?name=John+Doe&size=128" alt="Profile">
                </div>
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-gray-900">John Doe</h1>
                    <p class="text-gray-600 mt-1">Full-stack Developer</p>
                    <div class="mt-1 flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        San Francisco, CA
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-100 px-6 py-4">
            <div class="flex space-x-8">
                <div class="flex-1">
                    <div class="text-2xl font-bold text-gray-900">42</div>
                    <div class="text-sm text-gray-500">Posts</div>
                </div>
                <div class="flex-1">
                    <div class="text-2xl font-bold text-gray-900">1.2k</div>
                    <div class="text-sm text-gray-500">Followers</div>
                </div>
                <div class="flex-1">
                    <div class="text-2xl font-bold text-gray-900">238</div>
                    <div class="text-sm text-gray-500">Following</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Posts List -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Tabs -->
        <div class="border-b border-gray-100">
            <nav class="flex">
                <button class="px-6 py-4 text-sm font-medium text-blue-600 border-b-2 border-blue-600">All Posts</button>
                <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">Published</button>
                <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">Drafts</button>
            </nav>
        </div>

        <!-- Posts -->
        <div class="divide-y divide-gray-100">
            <!-- Post Item -->
            <div class="p-6 flex items-center hover:bg-gray-50">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="#" class="hover:text-blue-600">Getting Started with Laravel 10</a>
                    </h3>
                    <p class="text-gray-600 mb-2 line-clamp-2">Learn how to set up a new Laravel 10 project and explore its new features. We'll cover installation, configuration, and basic concepts.</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            March 15, 2024
                        </span>
                        <span class="mx-2">•</span>
                        <span>5 min read</span>
                        <span class="mx-2">•</span>
                        <span>2.1k views</span>
                    </div>
                </div>
                <div class="ml-6 flex items-center space-x-2">
                    <button class="p-2 text-gray-500 hover:text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </button>
                    <button class="p-2 text-gray-500 hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Post Item -->
            <div class="p-6 flex items-center hover:bg-gray-50">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="#" class="hover:text-blue-600">Vue.js 3 Composition API Guide</a>
                    </h3>
                    <p class="text-gray-600 mb-2 line-clamp-2">Deep dive into Vue.js 3's Composition API and learn how to build more maintainable and reusable components.</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            March 10, 2024
                        </span>
                        <span class="mx-2">•</span>
                        <span>8 min read</span>
                        <span class="mx-2">•</span>
                        <span>1.5k views</span>
                    </div>
                </div>
                <div class="ml-6 flex items-center space-x-2">
                    <button class="p-2 text-gray-500 hover:text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </button>
                    <button class="p-2 text-gray-500 hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Post Item -->
            <div class="p-6 flex items-center hover:bg-gray-50">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="#" class="hover:text-blue-600">Building RESTful APIs with Laravel</a>
                    </h3>
                    <p class="text-gray-600 mb-2 line-clamp-2">Learn how to design and implement RESTful APIs using Laravel's powerful features and best practices.</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            March 5, 2024
                        </span>
                        <span class="mx-2">•</span>
                        <span>10 min read</span>
                        <span class="mx-2">•</span>
                        <span>3.2k views</span>
                    </div>
                </div>
                <div class="ml-6 flex items-center space-x-2">
                    <button class="p-2 text-gray-500 hover:text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </button>
                    <button class="p-2 text-gray-500 hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection