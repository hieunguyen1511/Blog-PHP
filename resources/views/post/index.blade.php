@extends('layouts.adminLayout')
@section('content')

<div class="max-w-6xl mx-auto p-4 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">{{ __('language.title_post_index') }}</h2>
        <div class="flex space-x-2">
            <!-- Nút Xóa danh mục đã chọn -->
            <button id="deleteSelected" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                {{ __('language.btn_delete_items') }}
            </button>
        </div>
    </div>

    <table id="postTable" class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-2"><input type="checkbox" id="selectAll" class="w-4 h-4"></th>
                <th class="p-2">ID</th>
                <th class="p-2">{{__('language.title_user')}}</th>
                <th class="p-2">{{__('language.title_name_category')}}</th>
                <th class="p-2">{{__('language.title_post')}}</th>
                <th class="p-2">{{__('language.title_description_post')}}</th>
                <th class="p-2">{{__('language.title_content_post')}}</th>
                <th class="p-2">{{__('language.title_create_at')}}</th>
                <th class="p-2">{{__('language.title_action')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div id="editPostModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl max-h-[80vh] overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4 text-center">{{ __('language.title_edit_post') }}</h2>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Post Header -->
            <div class="p-6 border-b border-gray-100">
                <h1 id="title-post" class="text-2xl font-bold text-gray-900 mb-4"></h1>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span id="post-create-at"></span>
                    </div>
                    <a id="a-user" href="#" class="flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span id="user-full-name"></span>
                    </a>
                </div>
            </div>

            <!-- Post Content -->
            <div class="p-6 overflow-hidden break-words max-w-full" id="post-content">
                {{-- encode html --}}
            </div>

            <!-- Post Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-thumbs-up mr-2 text-blue-600"></i>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500">
                                <span class="like-count" id="post-like-count"></span> {{ __('language.detail_post_like') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-eye text-green-500"></i>
                        <span class="text-sm text-gray-500">
                            <span id="post-view-count"></span> {{ __('language.detail_post_view') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-4 bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900"><span id="post-comment-count"></span> {{ __('language.detail_post_comment') }}</h2>
            </div>
            <div class="p-4">
                <div id="load-comment" class="space-y-4">
                    {{-- Danh sách bình luận --}}
                </div>
                <div class="text-center mt-4">
                    <button id="load-more-comments" class="w-full px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-blue-600">
                        {{ __('language.detail_post_load_more') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Close Button -->
        <div class="text-center mt-4">
            <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">{{ __('language.btn_cancel') }}</button>
        </div>
    </div>
</div>


<script>
    let comment_count = 0;
    var currentLocale = "{{ app()->getLocale() }}";  // Lấy locale từ Laravel
    $(document).ready(function() {
        let table = $('#postTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('post.getAll') }}",
                dataSrc: 'posts' // Dữ liệu từ API
            },
            columns: [
                { 
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="rowCheckbox w-4 h-4 text-blue-600 border-gray-300 rounded" value="${row.id}">`;
                    }
                },
                { data: 'id', name: 'id' },
                { data: 'user', name: 'user', render: function(data, type, row) {
                    var profile = "{{ route('get-profile', ['username' => ':username']) }}".replace(':username', row.user.username);
                    return `
                        <a href="${profile}" class="flex items-center space-x-3">
                            <img class="w-10 h-10 rounded-full" src="${row.user.profile_picture ? row.user.profile_picture : '/default_avatar.jpg'}" alt="${row.user.full_name}">
                            <span>${row.user.full_name}</span>
                        </a>
                    `;
                } },
                { data: 'category_name', name: 'category_name', render: function(data) {
                    return truncateText(data, 10);
                }  },
                { data: 'title', name: 'title', render: function(data) {
                    return truncateText(data, 10);
                }  },
                { data: 'description', name: 'description', render: function(data) {
                    return truncateText(data, 10);
                }  },
                { data: 'content', name: 'content', render: function(data) {
                    return truncateText($('<div/>').html(data).text(), 10);
                }},
                { data: 'created_at', name: 'created_at' },
                { 
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="flex space-x-2">
                            <button onclick="openEditModal(${row.id})" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">{{ __('language.btn_detail') }}</button>
                            <button class="delete-btn px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600" data-id="${row.id}">
                                {{ __('language.btn_delete') }}
                            </button>
                        </div>`;
                    }
                }
            ],
            language: {
                url: `//cdn.datatables.net/plug-ins/1.13.6/i18n/${currentLocale}.json`
            }
        });

        // Sự kiện chọn tất cả checkbox
        $('#selectAll').on('change', function() {
            $('.rowCheckbox').prop('checked', this.checked);
        });

        // Kiểm tra trạng thái của checkbox khi chọn từng hàng
        $(document).on('change', '.rowCheckbox', function() {
            if ($('.rowCheckbox:checked').length === $('.rowCheckbox').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });

        function deletePost(postId) {
            Swal.fire({
                title: "{{__('language.title_confirm_delete')}}",
                text: "{{__('language.confirm_delete_item')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{__('language.confirm_yes')}}",
                cancelButtonText: "{{__('language.btn_cancel')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gọi hàm xóa nếu người dùng xác nhận
                    $.ajax({
                        url: `{{ route('post.delete', ':id') }}`.replace(':id', postId),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}" // Laravel CSRF token để bảo mật
                        },
                        success: function(response) {
                            if (response.status == '200') {
                                table.ajax.reload(function() {
                                    toastr.success(response.message, "{{__('language.message_success')}}", {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                                    });
                                });  // Làm mới bảng dữ liệu
                            } else {
                                toastr.error(response.message, "{{__('language.message_fail')}}", {
                                    closeButton: true,
                                    progressBar: true,
                                    timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                    positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                                });
                            }
                            
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                            });
                            alert();
                        }
                    });
                }
            });
        }

        $('#postTable').on('click', '.delete-btn', function() {
            var postId = $(this).data('id'); // Lấy id từ data-id của button
            deletePost(postId);  // Gọi hàm deleteCategory với ID
        });


        // Xóa nhiều danh mục
        $('#deleteSelected').on('click', function() {
            let selectedIds = [];
            $('.rowCheckbox:checked').each(function() {
                selectedIds.push($(this).val());
            });
        
            if (selectedIds.length === 0) {
                toastr.warning("{{__('language.error_no_item_selected')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                    positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                });
                return;
            }

            Swal.fire({
                title: "{{__('language.title_confirm_delete')}}",
                text: "{{__('language.confirm_delete_items')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{__('language.confirm_yes')}}",
                cancelButtonText: "{{__('language.btn_cancel')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gọi hàm xóa nếu người dùng xác nhận
                    $.ajax({
                        url: `{{ route('post.deleteItems') }}`,
                        type: "POST",
                        data: {
                            ids: selectedIds,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == '200') {
                                table.ajax.reload(function() {
                                    toastr.success(response.message, "{{__('language.message_success')}}", {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                                    });
                                });
                            } else {
                                table.ajax.reload(function() {
                                    toastr.error(response.message, "{{__('language.message_fail')}}", {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                                    });
                                });
                            }
                            
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                            });
                        }
                    });
                }
            });
        });
    });

    function loadComments(comments, load_comment, has_more) {
        let defaultAvatar = "{{ asset('default_avatar.jpg') }}";

        comments.reverse().forEach(comment => {
            load_comment.append(`
                <div class="flex space-x-4 items-start" id="comment-${comment.id}">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" 
                            src="${comment.user?.profile_picture ? comment.user.profile_picture : defaultAvatar}" 
                            alt="${comment.user.full_name}">
                    </div>

                    <!-- Nội dung comment -->
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <div>
                                <span class="font-medium text-gray-900">${comment.user.full_name}</span>
                                <span class="ml-2 text-sm text-gray-500">${comment.created_at}</span>
                            </div>

                            <!-- Nút xóa -->
                            <button onclick="deleteComment(${comment.id})" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <p class="text-gray-700">${comment.content}</p>
                    </div>
                </div>
            `);
        });

        if (has_more) {
            $("#load-more-comments").show();
        } else {
            $("#load-more-comments").hide();
        }
    }

    function deleteComment(commentId) {
        Swal.fire({
            title: "{{__('language.title_confirm_delete')}}",
            text: "{{__('language.confirm_delete_item')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "{{__('language.confirm_yes')}}",
            cancelButtonText: "{{__('language.btn_cancel')}}",
        }).then((result) => {
            if (result.isConfirmed) {
                // Gọi hàm xóa nếu người dùng xác nhận
                $.ajax({
                    url: `{{ route('post.deleteComment', ':id') }}`.replace(':id', commentId),
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}" // Laravel CSRF token để bảo mật
                    },
                    success: function(response) {
                        if (response.status === '200') {
                            $(`#comment-${commentId}`).remove(); // Xóa comment khỏi giao diện
                            comment_count--;
                            $("#post-comment-count").text(formatNumber(comment_count));
                        } else {
                            toastr.error(response.message, "{{__('language.message_fail')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                            });
                        }
                        
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                            positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                        });
                        alert();
                    }
                });
            }
        });
    }

    function openEditModal(postId) {
        let offset = 4; // Số thông báo đã tải ban đầu
            // Gửi request AJAX để lấy thông tin category
        $.ajax({
            url: `{{ route('post.get', ':id') }}`.replace(':id', postId),
            type: "GET",
            success: function(response) {
                if (response.status === '200') {
                    var postId = response.post.id;
                    $("#title-post").text(response.post.title);
                    $("#post-create-at").text(response.post.created_at);
                    document.getElementById('a-user').href = "{{ route('get-profile', ['username' => ':username']) }}".replace(':username', response.post.user.username);
                    $("#user-full-name").text(response.post.user.full_name);
                    $("#post-content").html(response.post.content);
                    $("#post-like-count").text(formatNumber(response.post.like_count));
                    $("#post-view-count").text(formatNumber(response.post.view_count));
                    comment_count = response.post.comment_count;
                    $("#post-comment-count").text(formatNumber(comment_count));
                    
                    let load_comment = $('#load-comment');
                    load_comment.empty();
                    loadComments(response.post.comments, load_comment, response.has_more);
                    $(document).on("click", "#load-more-comments", function() {
                        $.ajax({
                            url: "{{ route('post.getLoadMoreComments') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                offset: offset,
                                postId: postId,
                            },
                            success: function(response) {
                                if (response.status === '200') {
                                    loadComments(response.comments, $('#load-comment'), response.has_more);
                                }
                            },
                            error: function(xhr) {
                                console.error("Lỗi khi tải thông báo:", xhr.responseText);
                            }
                        });
                    });

                    $("#editPostModal").removeClass("hidden");
                } else {
                    toastr.error("{{ __('language.error_fetching_data') }}", "{{__('language.message_fail')}}", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                    });
                }
            },
            error: function() {
                toastr.error("{{ __('language.error_fetching_data') }}", "{{__('language.message_fail')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                    positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                });
            }
        });
        
    }

    // Đóng modal
    function closeEditModal() {
        $("#editPostModal").addClass("hidden");
    }
</script>

@endsection