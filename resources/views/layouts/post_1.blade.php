@extends('layouts.userLayout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Post Header -->
                <div class="p-6 border-b border-gray-100">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">How to Build a Modern Web Application with Laravel and Vue.js</h1>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            March 15, 2024
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            John Doe
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Web Development
                        </div>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="p-6 prose max-w-none">
                    <p>In this comprehensive guide, we'll explore how to build a modern web application using Laravel and Vue.js. We'll cover everything from setting up your development environment to deploying your application to production.</p>
                    
                    <h2>Getting Started</h2>
                    <p>First, let's set up our development environment. You'll need PHP, Composer, Node.js, and npm installed on your machine.</p>
                    
                    <h3>Prerequisites</h3>
                    <ul>
                        <li>PHP 8.1 or higher</li>
                        <li>Composer</li>
                        <li>Node.js and npm</li>
                        <li>A code editor (VS Code recommended)</li>
                    </ul>
                    
                    <h2>Setting Up Laravel</h2>
                    <p>Let's start by creating a new Laravel project...</p>
                </div>

                <!-- Post Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button class="flex items-center text-gray-500 hover:text-blue-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                </svg>
                                Like
                            </button>
                            <button class="flex items-center text-gray-500 hover:text-blue-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                                Share
                            </button>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500">1,234 views</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900">Comments</h2>
                </div>
                <div class="p-6">
                    <!-- Add comment form -->
                    <form class="mb-6">
                        <textarea 
                            class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            rows="4" 
                            placeholder="Add a comment..."></textarea>
                        <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Post Comment
                        </button>
                    </form>

                    <!-- Comments list -->
                    <div class="space-y-6">
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Sarah+Wilson" alt="">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <span class="font-medium text-gray-900">Sarah Wilson</span>
                                    <span class="ml-2 text-sm text-gray-500">2 hours ago</span>
                                </div>
                                <p class="text-gray-700">Great tutorial! I especially liked the section about Vue.js components integration with Laravel.</p>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Mike+Brown" alt="">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <span class="font-medium text-gray-900">Mike Brown</span>
                                    <span class="ml-2 text-sm text-gray-500">5 hours ago</span>
                                </div>
                                <p class="text-gray-700">Could you explain more about the authentication process? I'm having trouble implementing it in my project.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Author Info -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900">About Author</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-12 w-12 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe" alt="">
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">John Doe</h3>
                            <p class="text-sm text-gray-500">42 posts</p>
                        </div>
                    </div>
                    <p class="text-gray-600">Full-stack developer with 5+ years of experience in Laravel and Vue.js. Passionate about creating modern web applications and sharing knowledge with the community.</p>
                    <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Follow
                    </button>
                </div>
            </div>

            <!-- Related Posts -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900">Related Posts</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    <a href="#" class="block p-6 hover:bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Getting Started with Laravel 10</h3>
                        <p class="text-sm text-gray-500">March 10, 2024</p>
                    </a>
                    <a href="#" class="block p-6 hover:bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Vue.js 3 Composition API Tutorial</h3>
                        <p class="text-sm text-gray-500">March 8, 2024</p>
                    </a>
                    <a href="#" class="block p-6 hover:bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Building RESTful APIs with Laravel</h3>
                        <p class="text-sm text-gray-500">March 5, 2024</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection