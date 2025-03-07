<!-- Main Content Area -->
<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
    <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">
        {{ __('language.header_notifications_comment') }}</h3>
    <div id="comment-content">
        @foreach ($noti_comments_seen as $item)
            @if ($item->is_seen == 0)
                <a href="#" onclick="document.getElementById('cmt_post_id_{{ $item->post->id }}').submit()"
                    class="block px-4 py-3 bg-green-200 hover:bg-green-300 transition ease-in-out duration-150">
                    <p class="text-sm font-medium text-gray-900">
                        {{ $item->user->full_name . ' ' . __('language.header_notifications_content_comment') . ' "' . $item->post->title . '"' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $item->created_at->format('d/m/Y H:i') }}</p>
                    <form id="cmt_post_id_{{ $item->post->id }}" hidden action="{{ route('process_noti_comment') }}"
                        method="POST">
                        @csrf
                        <input hidden type="text" id="cmt_id" name="cmt_id" value="{{ $item->id }}">

                    </form>
                </a>
            @else
                <a href="#" onclick="document.getElementById('cmt_post_id_{{ $item->post->id }}').submit()"
                    class="block px-4 py-3 hover:bg-gray-200 transition ease-in-out duration-150">
                    <p class="text-sm font-medium text-gray-900">
                        {{ $item->user->full_name . ' ' . __('language.header_notifications_content_comment') . ' "' . $item->post->title . '"' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $item->created_at->format('d/m/Y H:i') }}</p>
                    <form id="cmt_post_id_{{ $item->post->id }}" hidden action="{{ route('process_noti_comment') }}"
                        method="POST">
                        @csrf
                        <input hidden type="text" id="cmt_id" name="cmt_id" value="{{ $item->id }}">

                    </form>
                </a>
            @endif
        @endforeach
    </div>
    <div id="like-content">
        <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">
            {{ __('language.header_notifications_like') }}</h3>
        @foreach ($noti_likes_seen as $item)
            @if ($item->is_seen == 0)
                <a href="#" onclick="document.getElementById('like_post_id_{{ $item->post->id }}').submit()"
                    class="block px-4 py-3 bg-green-200 hover:bg-green-300 transition ease-in-out duration-150">
                    <p class="text-sm font-medium text-gray-900">
                        {{ $item->user->full_name . ' ' . __('language.header_notifications_content_like') . ' "' . $item->post->title . '"' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $item->created_at->format('d/m/Y H:i') }}</p>
                    <form id="like_post_id_{{ $item->post->id }}" hidden action="{{ route('process_noti_like') }}"
                        method="POST">
                        @csrf
                        <input hidden type="text" id="like_id" name="like_id" value="{{ $item->id }}">

                    </form>
                </a>
            @else
                <a href="#" onclick="document.getElementById('like_post_id_{{ $item->post->id }}').submit()"
                    class="block px-4 py-3 hover:bg-gray-200 transition ease-in-out duration-150">
                    <p class="text-sm font-medium text-gray-900">
                        {{ $item->user->full_name . ' ' . __('language.header_notifications_content_like') . ' "' . $item->post->title . '"' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $item->created_at->format('d/m/Y H:i') }}</p>
                    <form id="like_post_id_{{ $item->post->id }}" hidden action="{{ route('process_noti_like') }}"
                        method="POST">
                        @csrf
                        <input hidden type="text" id="like_id" name="like_id" value="{{ $item->id }}">

                    </form>
                </a>
            @endif
        @endforeach
    </div>
    <div class="text-center mt-6">
        <button id="loadmorenoti"
            class="w-full px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-offset-2">
            {{ __('language.setting_post_notification_load') }}
        </button>
    </div>
</div>

<script>
    var page = 1;
    var load_more_noti = document.getElementById('loadmorenoti');
    load_more_noti.addEventListener('click', function() {
        $.ajax({
            url: "{{ route('post_notification') }}",
            type: "GET",
            data: {
                page: ++page
            },
            success: function(response) {
                //console.log(response.noti_comments_seen.data);
                //console.log(response.noti_likes_seen.data);
                if (response.noti_comments_seen.data.length == 0 && response.noti_likes_seen.data
                    .length == 0) {
                    load_more_noti.style.display = 'none';
                } else {
                    document.getElementById('comment-content').innerHTML += response
                        .noti_comments_seen.data.map(
                            item => `<a href="#" onclick="document.getElementById('cmt_post_id_${item.post.id}').submit()"
                                        class="block px-4 py-3 hover:bg-gray-200 transition ease-in-out duration-150">
                                    <p class="text-sm font-medium text-gray-900">
                                        ${item.user.full_name} {{ ' ' . __('language.header_notifications_content_comment') . ' "' }} ${item.post.title} {{ '"' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        ${formatDate(item.created_at)}</p>
                                    <form id="cmt_post_id_${item.post.id}" hidden action="{{ route('process_noti_comment') }}"
                                            method="POST">
                                    @csrf
                                    <input hidden type="text" id="cmt_id" name="cmt_id" value="${item.id}">

                                    </form>
                                    </a>`
                        ).join('');
                    document.getElementById('like-content').innerHTML += response.noti_likes_seen
                        .data.map(
                            item => `<a href="#" onclick="document.getElementById('like_post_id_${item.post.id}').submit()"
                                    class="block px-4 py-3 hover:bg-gray-200 transition ease-in-out duration-150">
                                    <p class="text-sm font-medium text-gray-900">
                                        ${item.user.full_name} {{ ' ' . __('language.header_notifications_content_like') . ' "' }} ${item.post.title} {{ '"' }} }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        ${formatDate(item.created_at)}</p>
                                    <form id="like_post_id_${item.post.id}" hidden action="{{ route('process_noti_like') }}"
                                        method="POST">
                                        @csrf
                                        <input hidden type="text" id="like_id" name="like_id" value="${item.id}">

                                    </form>
                                </a>`
                        ).join('');
                }
            }
        });
    });

    function formatDate(date) {
        var d = new Date(date);
        return String(d.getDate()).padStart(2, '0') + "/" + String(d.getMonth() + 1).padStart(2, '0') + "/" + d.getFullYear() + " " + d
            .getHours() + ":" + d.getMinutes();
    }
</script>
