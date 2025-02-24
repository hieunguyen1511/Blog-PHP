@extends('layouts.userLayout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Post Header -->
                <div class="p-6 border-b border-gray-100">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{$post->title}}</h1>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{$post->created_at->format('d/m/Y')}}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{$post->user->full_name}}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <a href="{{route('category.post',['link'=>$post->category->link])}}">{{$post->category->name}}</a>
                            
                        </div>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="p-6 prose max-w-none">
                    <?php echo htmlspecialchars_decode(stripslashes($post->content));  ?>
                </div>

                <!-- Post Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @if($is_like == false)
                            @else
                            @endif
                            <button class="flex items-center text-gray-500 hover:text-blue-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                </svg>
                                {{__('language.detail_post_like')}}
                            </button>
                            {{-- <button class="flex items-center text-gray-500 hover:text-blue-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                                Share
                            </button> --}}
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500">{{$post->view_count}} {{__('language.detail_post_view')}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900">{{__('language.detail_post_comment')}}</h2>
                </div>
                <div class="p-6">
                    <!-- Add comment form -->
                    <form method="post" action="{{route('post_comment')}}" class="mb-6">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <textarea name="content" id="content"
                            class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            rows="4" 
                            placeholder="Add a comment..." required></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{__('language.detail_post_submit_comment')}}
                        </button>
                    </form>

                    <!-- Comments list -->
                    <div id="load-comment" class="space-y-6">
                        @foreach ($comments as $item)
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="{{$item->user->profile_picture}}" alt="">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <span class="font-medium text-gray-900">{{$item->user->full_name}}</span>
                                    <span class="ml-2 text-sm text-gray-500">{{$item->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('Y/m/d H:i')}}</span>
                                </div>
                                <p class="text-gray-700">{{$item->content}}</p>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                    <!-- Load More Button -->
                    <div class="text-center mt-6">
                        <button id="load-more-comments" 
                                class="w-full px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-offset-2">
                            {{__('language.detail_post_load_more')}}
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Author Info -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900">{{__('language.detail_post_about_author')}}</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-12 w-12 rounded-full" src="{{$post->user->profile_picture}}" alt="">
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">{{$post->user->full_name}}</h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>{{$post->user->posts->count().' '.__('language.detail_post_posts')}}</span>
                                <span class="text-gray-300">•</span>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>{{$post->user->posts->sum('view_count')}} views</span>
                                </div>
                                <span class="text-gray-300">•</span>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    <span>{{$post->user->posts->sum('like_count')}} {{__('language.detail_post_like')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">{{$post->user->bio}}</p>
                    <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <a href="{{route('get-profile',['username'=>$post->user->username])}}">{{__('language.detail_post_view_profile')}}</a>
                    </button>
                </div>
            </div>

            <!-- Related Posts -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900">{{__('language.detail_post_related_post')}}</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach ($related_posts as $item)
                    <a href="{{route('post-detail',['link'=>$item->link])}}" class="block p-6 hover:bg-gray-50">
                        <p class="text-sm text-gray-500 mb-2">{{$item->created_at->format('d/m/Y')}}</p>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{$item->title}}</h3>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>{{$item->view_count.' '.__('language.detail_post_like')}}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                <span>{{$item->like_count.' '.__('language.detail_post_like')}}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <span>{{$item->comments->count().' '.__('language.detail_post_comment')}}</span>
                            </div>
                        </div>
                        
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var page = 1;
    $("#load-more-comments").click(function(){
        var post_id = "{{$post->id}}";
        var last_comment_id = $("#load-comment").children().last().attr('id');
        $.ajax({
            url: "/post/{{$post->link}}",
            type: "GET",
            data: {
                page: ++page,
            },
            success: function(response){
                if(response.comments.data.length == 0){
                    $("#load-more-comments").hide();
                }
                document.getElementById('load-comment').innerHTML += response.comments.data.map(
                    comment => `<div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="${comment.user.profile_picture}" alt="">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <span class="font-medium text-gray-900">${comment.user.full_name}</span>
                                    <span class="ml-2 text-sm text-gray-500">${formatDate(comment.created_at)}</span>
                                </div>
                                <p class="text-gray-700">${comment.content}</p>
                            </div>
                        </div>`
                ).join('');
            }
        });
    });

    function formatDate(date){
        var d = new Date(date);
        return d.getDate() + "/" + String(d.getMonth() + 1).padStart(2, '0') + "/" + d.getFullYear() + " " + d.getHours() + ":" + d.getMinutes();
    }

</script>

@endsection