@extends('layouts.userLayout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
        <div class="relative h-64">
            <div class="w-full h-full overflow-hidden">
                <img src="{{$user->cover_photo}}" 
                     alt="Cover Photo" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
        </div>
        <div class="px-6 py-4">
            <div class="flex items-start">
                <div class="relative">
                    <img class="h-24 w-24 rounded-full border-4 border-white bg-white" src="{{$user->profile_picture}}" alt="Profile">
                </div>
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-gray-900">{{$user->full_name}}</h1>
                    <p class="text-gray-600 mt-1">{{'@'.$user->username}}</p>
                
                </div>
            </div>
        </div>
        <div class="border-t border-gray-100 px-6 py-4">
            <div class="flex space-x-8">
                <div class="flex-1">
                    <div class="text-2xl font-bold text-gray-900">{{$user->posts->count()}}</div>
                    <div class="text-sm text-gray-500">{{__('language.profile_posts')}}</div>
                </div>
                <div class="flex-1">
                    <div class="text-2xl font-bold text-gray-900">{{$user->posts->sum('view_count')}}</div>
                    <div class="text-sm text-gray-500">{{__('language.profile_views')}}</div>
                </div>
                <div class="flex-1">
                    <div class="text-2xl font-bold text-gray-900">{{$user->posts->sum('like_count')}}</div>
                    <div class="text-sm text-gray-500">{{__('language.profile_likes')}}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Posts List -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Tabs -->
        <div class="border-b border-gray-100">
            <nav class="flex">
                <button class="px-6 py-4 text-sm font-medium text-blue-600 border-b-2 border-blue-600">{{__('language.profile_allPosts')}}</button>
                {{-- <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">Published</button>
                <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">Drafts</button> --}}
            </nav>
        </div>

        <!-- Posts -->
        <div class="divide-y divide-gray-100">
            @foreach ($posts as $item )
                <!-- Post Item -->
            <div class="p-6 flex items-center hover:bg-gray-50">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="{{ route('post-detail', ['link' => $item->link]) }}" class="hover:text-blue-600">{{$item->title}}</a>
                    </h3>
                    <p class="text-gray-600 mb-2 line-clamp-2">{{ Str::limit($item->description, 100, '...') }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $item->created_at->format('Y-m-d') }}
                        </span>
                        {{-- <span class="mx-2">•</span> --}}
                        {{-- <span>8 min read</span> --}}
                        <span class="mx-2">•</span>
                        <span>{{$item->view_count}} {{__('language.profile_views')}}</span>
                    </div>
                </div>
               
            </div>
            @endforeach
            
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection