@extends('layouts.userLayout')
@section('content')
<div class="container mx-auto px-4 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Sidebar -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Categories</h3>
                </div>
                <div class="p-2">
                    <a href="/category/all" class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-sm text-gray-700">All Categories</span>
                        <span class="text-xs text-gray-500">128</span>
                    </a>
                    <a href="/category/technology" class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="text-sm text-gray-700">Technology</span>
                        <span class="text-xs text-gray-500">45</span>
                    </a>
                    <a href="/category/lifestyle" class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-green-50 hover:text-green-600 transition-colors duration-200">
                        <span class="text-sm text-gray-700">Lifestyle</span>
                        <span class="text-xs text-gray-500">23</span>
                    </a>
                    <a href="/category/travel" class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-yellow-50 hover:text-yellow-600 transition-colors duration-200">
                        <span class="text-sm text-gray-700">Travel</span>
                        <span class="text-xs text-gray-500">19</span>
                    </a>
                    <a href="/category/food" class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                        <span class="text-sm text-gray-700">Food</span>
                        <span class="text-xs text-gray-500">15</span>
                    </a>
                    <a href="/posts/following" class="flex items-center px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 hover:text-green-600 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                        <span class="text-sm">Following</span>
                    </a>
                </div>
            </div>

            <!-- Popular Tags -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-6">
                <div class="p-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Popular Tags</h3>
                </div>
                <div class="p-4">
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#webdev</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#javascript</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#php</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#laravel</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#ui</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#design</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:w-3/4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Blog posts -->
                    <div class="lg:col-span-3">
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h1 class="text-3xl font-bold mb-8">Latest Posts</h1>
                                <!-- Sample blog posts -->
                                <article class="mb-8 pb-8 border-b border-gray-200">
                                    <h2 class="text-2xl font-semibold mb-2">
                                        <a href="/post/1" class="text-gray-900 hover:text-blue-600">Sample Blog Post Title
                                            1</a>
                                    </h2>
                                    <div class="flex items-center gap-4 mb-4">
                                        <p class="text-gray-600">Published on January 1, 2023 by John Doe</p>
                                        <span class="text-gray-400">•</span>
                                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">Programming</span>
                                    </div>
                                    <p class="text-gray-700 mb-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                                        incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                        laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                    <a href="/post/1" class="text-blue-600 hover:text-blue-800">Read more →</a>
                                </article>
                                <article class="mb-8 pb-8 border-b border-gray-200">
                                    <h2 class="text-2xl font-semibold mb-2">
                                        <a href="/post/2" class="text-gray-900 hover:text-blue-600">Sample Blog Post Title
                                            2</a>
                                    </h2>
                                    <div class="flex items-center gap-4 mb-4">
                                        <p class="text-gray-600">Published on January 5, 2023 by Jane Smith</p>
                                        <span class="text-gray-400">•</span>
                                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">Web Design</span>
                                    </div>
                                    <p class="text-gray-700 mb-4">
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur.
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                        mollit anim id est laborum.
                                    </p>
                                    <a href="/post/2" class="text-blue-600 hover:text-blue-800">Read more →</a>
                                </article>
                                <article class="mb-8">
                                    <h2 class="text-2xl font-semibold mb-2">
                                        <a href="/post/3" class="text-gray-900 hover:text-blue-600">Sample Blog Post Title
                                            3</a>
                                    </h2>
                                    <div class="flex items-center gap-4 mb-4">
                                        <p class="text-gray-600">Published on January 10, 2023 by Mike Johnson</p>
                                        <span class="text-gray-400">•</span>
                                        <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">Technology</span>
                                    </div>
                                    <p class="text-gray-700 mb-4">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                        doloremque laudantium,
                                        totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                                        beatae vitae dicta sunt explicabo.
                                    </p>
                                    <a href="/post/3" class="text-blue-600 hover:text-blue-800">Read more →</a>
                                </article>
                            </div>
                            <!-- Pagination -->
                            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                                <nav class="flex items-center justify-between">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <a href="#"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Previous
                                        </a>
                                        <a href="#"
                                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Next
                                        </a>
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700">
                                                Showing <span class="font-medium">1</span> to <span
                                                    class="font-medium">3</span> of <span class="font-medium">12</span>
                                                results
                                            </p>
                                        </div>
                                        <div>
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                                aria-label="Pagination">
                                                <a href="#"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    <span class="sr-only">Previous</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                                <a href="#" aria-current="page"
                                                    class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    1
                                                </a>
                                                <a href="#"
                                                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    2
                                                </a>
                                                <a href="#"
                                                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">
                                                    3
                                                </a>
                                                <span
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                    ...
                                                </span>
                                                <a href="#"
                                                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">
                                                    8
                                                </a>
                                                <a href="#"
                                                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    9
                                                </a>
                                                <a href="#"
                                                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    10
                                                </a>
                                                <a href="#"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    <span class="sr-only">Next</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </nav>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <!-- Recommended Users -->
                        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-4">Recommended Users</h3>
                                <ul class="space-y-4">
                                    <li class="flex items-center space-x-3">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                                            <p class="text-xs text-gray-500">Tech Enthusiast</p>
                                        </div>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael Chen">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Michael Chen</p>
                                            <p class="text-xs text-gray-500">Travel Blogger</p>
                                        </div>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily Rodriguez">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Emily Rodriguez</p>
                                            <p class="text-xs text-gray-500">Food Critic</p>
                                        </div>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/men/22.jpg" alt="David Kim">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">David Kim</p>
                                            <p class="text-xs text-gray-500">Fitness Guru</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

            <!-- Suggested Posts -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-6 flex items-center text-gray-900">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Suggested Posts
                    </h3>
                    <div class="space-y-4">
                        <a href="/post/suggested-1" class="block group hover:bg-gray-50 rounded-lg p-3 transition-colors duration-200">
                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                                10 Tips for Better Programming: Essential Practices for Clean Code
                            </p>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs text-gray-500">Jan 15, 2024</span>
                                <span class="text-gray-300">•</span>
                                <div class="flex gap-2 flex-wrap">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-50 text-blue-600">Programming</span>
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-50 text-gray-600">Clean Code</span>
                                </div>
                            </div>
                        </a>

                        <a href="/post/suggested-2" class="block group hover:bg-gray-50 rounded-lg p-3 transition-colors duration-200">
                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                                Getting Started with Laravel: A Comprehensive Guide for Beginners
                            </p>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs text-gray-500">Jan 12, 2024</span>
                                <span class="text-gray-300">•</span>
                                <div class="flex gap-2 flex-wrap">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-50 text-green-600">Laravel</span>
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-50 text-red-600">PHP</span>
                                </div>
                            </div>
                        </a>

                        <a href="/post/suggested-3" class="block group hover:bg-gray-50 rounded-lg p-3 transition-colors duration-200">
                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                                Web Design Trends 2024: Modern UI/UX Practices
                            </p>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs text-gray-500">Jan 10, 2024</span>
                                <span class="text-gray-300">•</span>
                                <div class="flex gap-2 flex-wrap">
                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-50 text-purple-600">Design</span>
                                    <span class="px-2 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">UI/UX</span>
                                </div>
                            </div>
                        </a>

                        <a href="/post/suggested-4" class="block group hover:bg-gray-50 rounded-lg p-3 transition-colors duration-200">
                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                                Understanding API Development: RESTful Best Practices
                            </p>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs text-gray-500">Jan 8, 2024</span>
                                <span class="text-gray-300">•</span>
                                <div class="flex gap-2 flex-wrap">
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-50 text-yellow-600">API</span>
                                    <span class="px-2 py-1 text-xs rounded-full bg-orange-50 text-orange-600">REST</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection