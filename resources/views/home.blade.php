@extends('layouts.userLayout')
@section('content')
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Sidebar -->
            <div class="lg:w-1/6">
                <!-- Popular Category -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden ">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('language.home_popular_categories') }}</h3>
                    </div>
                    <div class="p-2">
                        @foreach ($popular_category as $item)
                            <a href="{{ route('category.post', ['link' => $item->link]) }}"
                                class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <span class="text-sm text-gray-700">{{ $item->name }}</span>
                                <span class="text-xs text-gray-500">{{ $item->posts->count() }}</span>
                            </a>
                        @endforeach
                        {{-- <a href="/category/all"
                            class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-gray-50 transition-colors duration-200">
                            <span class="text-sm text-gray-700">All Categories</span>
                            <span class="text-xs text-gray-500">128</span>
                        </a> --}}


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

                {{-- <!-- Popular Tags -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-6">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Popular Tags</h3>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-wrap gap-2">
                            <a href="#"
                                class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#webdev</a>
                            <a href="#"
                                class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#javascript</a>
                            <a href="#"
                                class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#php</a>
                            <a href="#"
                                class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#laravel</a>
                            <a href="#"
                                class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#ui</a>
                            <a href="#"
                                class="px-3 py-1 bg-gray-100 text-sm text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">#design</a>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Main Content -->
            <div class="lg:w-5/6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                        <!-- Blog posts -->
                        <div class="lg:col-span-3">
                            <div class="bg-white shadow rounded-lg overflow-hidden">
                                <div class="p-6">
                                    {{-- <h1 class="text-3xl font-bold mb-8">Latest Posts</h1> --}}
                                    <!-- Sample blog posts -->
                                    @foreach ($posts as $item)
                                        <article class="mb-8 pb-8 border-b border-gray-200">
                                            <h2 class="text-2xl font-semibold mb-2">
                                                <a href="{{ route('post-detail', ['link' => $item->link]) }}"
                                                    class="text-gray-900 hover:text-blue-600">{{ $item->title }}</a>
                                            </h2>
                                            <div class="flex items-center gap-4 mb-4">
                                                <p class="text-gray-600">Published on
                                                    {{ $item->created_at->format('Y-m-d') }} by {{ $item->user->full_name }}
                                                </p>
                                                <span class="text-gray-400">•</span>
                                                <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm"><a
                                                        href="{{ route('category.post', ['link' => $item->category->link]) }}">{{ $item->category->name }}</a>
                                                </span>
                                            </div>
                                            <p class="text-gray-700 mb-4">
                                                {{ Str::limit($item->description, 100, '...') }}
                                            </p>
                                            {{-- <a href="{{ route('post-detail',['link'=>$item->link])}}" class="text-blue-600 hover:text-blue-800">Read more →</a> --}}
                                        </article>
                                    @endforeach


                                </div>
                                <!-- Pagination -->
                                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                                    {{ $posts->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-2">
                            <!-- Recommended Users -->
                            <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold mb-4">{{__('language.home_recommend_user')}}</h3>
                                    <ul class="space-y-4">
                                        <li
                                            class="flex items-start space-x-3 p-2 hover:bg-gray-50 rounded-lg transition-colors duration-150">
                                            <img class="h-10 w-10 rounded-full"
                                                src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                                                <p class="text-xs text-gray-500">Tech Enthusiast</p>
                                                <div class="flex items-center gap-3 mt-1">
                                                    <span class="text-xs text-gray-500 flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                                            </path>
                                                        </svg>
                                                        23 posts
                                                    </span>
                                                    <span class="text-xs text-gray-500 flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        15.2k views
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Suggested Posts -->
                            <div class="bg-white shadow rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold mb-6 flex items-center text-gray-900">
                                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                            </path>
                                        </svg>
                                        {{__('language.home_suggested_post')}}
                                    </h3>
                                    <div class="space-y-4">
                                        @foreach ($suggested_post as $item)
                                            <a href="{{ route('post-detail', ['link' => $item->link]) }}"
                                                class="block group hover:bg-gray-50 rounded-lg p-3 transition-colors duration-200">
                                                <p
                                                    class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                                                    {{ $item->title }}
                                                </p>
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <span
                                                        class="text-xs text-gray-500">{{ $item->created_at->format('Y-m-d') }}</span>
                                                    <span class="text-gray-300">•</span>
                                                    <div class="flex gap-2 flex-wrap">
                                                        <span
                                                            class="px-2 py-1 text-xs rounded-full bg-blue-50 text-blue-600">{{ $item->category->name }}</span>

                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
