@extends('layouts.adminLayout')
@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="max-w-6xl mx-auto p-4 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">{{ __('language.title_user_index') }}</h2>
        <div class="flex space-x-2">
            <!-- Nút Xóa danh mục đã chọn -->
            <button id="deleteSelected" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                {{ __('language.btn_delete_items') }}
            </button>
        </div>
    </div>

    <table id="userTable" class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-2"><input type="checkbox" id="selectAll" class="w-4 h-4"></th>
                <th class="p-2">ID</th>
                <th class="p-2">{{__('language.title_username_user')}}</th>
                <th class="p-2">{{__('language.title_email_user')}}</th>
                <th class="p-2">{{__('language.title_date_user')}}</th>
                <th class="p-2">{{__('language.title_phone_user')}}</th>
                <th class="p-2">{{__('language.title_bio_user')}}</th>
                <th class="p-2">{{__('language.title_fullname_user')}}</th>
                <th class="p-2">{{__('language.title_action')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<!-- Modal để sửa user -->
<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-h-[90vh] overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4">{{ __('language.title_edit_user') }}</h2>
        <form id="editUserForm">
            @csrf
            <input type="hidden" id="editUserId">

            <!-- Ảnh Profile & Cover -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="relative group flex flex-col items-center">
                    <img id="editProfilePic" alt="Profile Picture" class="w-28 h-28 rounded-full border-2 border-gray-300 object-cover cursor-pointer">
                    <input type="file" id="fileInputProfilePic" accept="image/*" class="hidden">
                    <div id="profilePicOverlay" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                        <span class="text-white text-sm font-semibold">{{ __('language.change_picture') }}</span>
                    </div>
                </div>

                <div class="relative group flex flex-col items-center w-full">
                    <img id="editCoverPhoto" alt="Cover Photo" 
                         class="w-full h-32 border-2 border-gray-300 object-contain cursor-pointer rounded-lg bg-gray-100">
                    <input type="file" id="fileInputCoverPhoto" accept="image/*" class="hidden">
                    <div id="coverPhotoOverlay" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                        <span class="text-white text-sm font-semibold">{{ __('language.change_picture') }}</span>
                    </div>
                </div>                
                
            </div>

            <!-- Các input -->
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="editUsername" class="block text-sm font-medium text-gray-700">{{ __('language.title_username_user') }}</label>
                    <input type="text" id="editUsername" class="w-full p-3 border rounded" placeholder="{{__('language.placeholder_username')}}">
                </div>

                <div class="mb-4">
                    <label for="editFullname" class="block text-sm font-medium text-gray-700">{{ __('language.title_fullname_user') }}</label>
                    <input type="text" id="editFullname" class="w-full p-3 border rounded" placeholder="{{ __('language.placeholder_fullname_user') }}">
                </div>

                <div class="mb-4 relative">
                    <label for="editDate" class="block text-sm font-medium text-gray-700">{{ __('language.title_date_user') }}</label>
                    <div class="relative">
                        <input type="text" id="editDate" class="w-full p-3 pr-10 border rounded" placeholder="{{ __('language.placeholder_date_user') }}">
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-lg" id="openCalendar">📅</span>
                    </div>
                </div>    

                <div class="mb-4">
                    <label for="editPhone" class="block text-sm font-medium text-gray-700">{{ __('language.title_phone_user') }}</label>
                    <input type="text" id="editPhone" class="w-full p-3 border rounded" placeholder="{{ __('language.placeholder_phone_user') }}" maxlength="10">
                </div>
                
                <div class="mb-4">
                    <label for="editNewPassword" class="block text-sm font-medium text-gray-700">{{ __('language.title_new_password_user') }}</label>
                    <input type="password" id="editNewPassword" class="w-full p-3 border rounded" placeholder="{{__('language.placeholder_new_password_user')}}">
                </div>
            </div>


            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('language.title_email_user') }}: <span id="editEmail" class="text-blue-500 font-semibold text-sm"></span></label>
            </div>
            <!-- Bio -->
            <div class="mb-4">
                <label for="editBio" class="block text-sm font-medium text-gray-700">{{ __('language.title_bio_user') }}</label>
                <textarea id="editBio" class="w-full p-3 border rounded h-28 resize-none" placeholder="{{ __('language.placeholder_bio_user') }}"></textarea>
            </div>

            <!-- Nút Submit -->
            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-5 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{ __('language.btn_edit') }}</button>
                <button type="button" onclick="closeEditModal()" class="px-5 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">{{ __('language.btn_cancel') }}</button>
            </div>
        </form>
    </div>
</div>




<script>
    var currentLocale = "{{ app()->getLocale() }}";  // Lấy locale từ Laravel
    $(document).ready(function() {
        let table = $('#userTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('user.getAll') }}",
                dataSrc: 'users' // Dữ liệu từ API
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
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'date', name: 'date' },
                { data: 'phone', name: 'phone' },
                { data: 'bio', name: 'bio' },
                { data: 'full_name', name: 'full_name' },
                { 
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="flex space-x-2">
                            <button onclick="openEditModal(${row.id})" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">{{ __('language.btn_edit') }}</button>
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


        // Xử lý submit form sửa category
        $("#editUserForm").submit(function(e) {
            e.preventDefault();

            let userId = $("#editCategoryId").val();
            let username = $("#editUsername").val();
            let new_password = $("#editNewPassword").val();
            let date = $("#editDate").val();
            let phone = $("#editPhone").val();
            let bio = $("#editBio").val();
            let fullname = $("#editFullname").val();
            //lấy ảnh nữa

            $.ajax({
                url: `/user/${userId}/update`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username,
                    new_password: new_password,
                    date: date,
                    phone: phone,
                    bio: bio,
                    fullname: fullname,
                },
                success: function(response) {
                    if (response.status === '200') {
                        $("#editUserModal").addClass("hidden");
                        table.ajax.reload(function() {
                            toastr.success(response.message, "{{__('language.message_success')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                            });
                        }); // Reload DataTable
                        
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
                }
            });
        });
        

        function deleteUser(userId) {
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
                        url: `/user/${userId}/delete`,
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

        $('#userTable').on('click', '.delete-btn', function() {
            var userId = $(this).data('id');
            deleteUser(userId);
        });


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
                        url: "/user/delete-items",
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


    function openEditModal(userId) {
            // Gửi request AJAX để lấy thông tin category
        $.ajax({
            url: `/user/${userId}`, // Đường dẫn API lấy thông tin
            type: "GET",
            success: function(response) {
                if (response.status === '200') {
                    $("#editUserId").val(response.user.id);
                    $("#editUsername").val(response.user.username);
                    $("#editEmail").text(response.user.email);
                    $("#editDate").val(response.user.date);
                    $("#editPhone").val(response.user.phone);
                    $("#editBio").val(response.user.bio);
                    $("#editFullname").val(response.user.fullname);
                    //hình ảnh nữa
                    $("#editUserModal").removeClass("hidden");
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
        $("#editUserModal").addClass("hidden");
    }

    document.addEventListener("DOMContentLoaded", function () {
        let profilePic = document.getElementById("editProfilePic");
        let fileInputProfilePic = document.getElementById("fileInputProfilePic");
        let profilePicOverlay = document.getElementById("profilePicOverlay");

        let coverPhoto = document.getElementById("editCoverPhoto");
        let fileInputCoverPhoto = document.getElementById("fileInputCoverPhoto");
        let coverPhotoOverlay = document.getElementById("coverPhotoOverlay");
        
        // Khi nhấn vào ảnh -> mở chọn file
        profilePicOverlay.addEventListener("click", function() {
            fileInputProfilePic.click();
        });

        // Khi người dùng chọn ảnh mới
        fileInputProfilePic.addEventListener("change", function (event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    profilePic.src = e.target.result; // Hiển thị ảnh mới
                };
                reader.readAsDataURL(file);
            }
        });

        // Khi nhấn vào ảnh -> mở chọn file
        coverPhotoOverlay.addEventListener("click", function () {
            fileInputCoverPhoto.click();
        });

        // Khi người dùng chọn ảnh mới
        fileInputCoverPhoto.addEventListener("change", function (event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.getElementById("editCoverPhoto");
                    coverPhoto.src = e.target.result; // Hiển thị ảnh mới
                    img.classList.add("object-contain"); // Đảm bảo ảnh được cắt vừa khung
                };
                reader.readAsDataURL(file);
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("editDate");
        const calendarIcon = document.getElementById("openCalendar");

        // Khởi tạo Flatpickr cho input
        const fp = flatpickr(dateInput, {
            dateFormat: "d/m/Y", // Định dạng ngày tháng
            allowInput: false, // Cho phép nhập tay
            defaultDate: new Date(), // Hiển thị ngày hiện tại
        });

        // Khi click icon thì mở lịch
        calendarIcon.addEventListener("click", function () {
            fp.open();
        });
    });
</script>

@endsection