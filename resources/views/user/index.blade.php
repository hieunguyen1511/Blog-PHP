@extends('layouts.adminLayout')
@section('content')

<div class="max-w-6xl mx-auto p-4 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">{{ __('language.title_user_index') }}</h2>
        <div class="flex space-x-2">
            <!-- Nút Xóa người dùng đã chọn -->
            <button id="deleteSelected" class="flex items-center gap-2 px-4 py-2 bg-red-500 text-white font-medium rounded-lg shadow-md hover:bg-red-600 hover:shadow-lg transition-all duration-300">
                <i class="fas fa-trash-alt"></i>
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
                <th class="p-2">{{__('language.title_full_name_user')}}</th>
                <th class="p-2">{{__('language.title_action')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<!-- Modal để sửa user -->
<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="relative bg-white rounded-2xl shadow-xl w-2/3 max-h-[90vh] overflow-y-auto p-0">
        <div class="sticky top-0 left-0 right-0 bg-white flex justify-between items-center px-6 py-3 border-b rounded-t-2xl z-50">
            <h2 class="text-xl font-bold text-blue-600">{{ __('language.title_edit_user') }}</h2>
            <button type="button" onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="pt-16 p-8">
            <form id="editUserForm" class="space-y-6">
                @csrf
                <input type="hidden" id="editUserId">

                <!-- Profile & Cover Photo -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative group flex flex-col items-center">
                        <img id="editProfilePic" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-gray-300 object-cover cursor-pointer shadow-md">
                        <input type="file" id="fileInputProfilePic" accept="image/*" class="hidden">
                        <div id="profilePicOverlay" class="absolute w-32 h-32 rounded-full bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                            <span class="text-white text-sm font-semibold">{{ __('language.change_picture') }}</span>
                        </div>
                    </div>
                    
                    <div class="relative group flex flex-col items-center w-full">
                        <img id="editCoverPhoto" alt="Cover Photo" class="w-full h-40 border-4 border-gray-300 object-cover cursor-pointer rounded-lg bg-gray-100 shadow-md">
                        <input type="file" id="fileInputCoverPhoto" accept="image/*" class="hidden">
                        <div id="coverPhotoOverlay" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer rounded-lg">
                            <span class="text-white text-sm font-semibold">{{ __('language.change_picture') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Input Fields -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="editFullname" class="block text-sm font-semibold text-gray-700">{{ __('language.title_full_name_user') }}</label>
                        <input type="text" id="editFullname" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="{{ __('language.placeholder_fullname_user') }}">
                    </div>
                    <div>
                        <label for="editDate" class="block text-sm font-semibold text-gray-700">{{ __('language.title_date_user') }}</label>
                        <div class="relative">
                            <input type="text" id="editDate" class="w-full p-3 pr-10 border rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="{{ __('language.placeholder_date_user') }}">
                            <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-lg text-gray-500" id="openCalendar">📅</span>
                        </div>
                    </div>
                    <div>
                        <label for="editPhone" class="block text-sm font-semibold text-gray-700">{{ __('language.title_phone_user') }}</label>
                        <input type="tel" pattern="[0-9]{10}" id="editPhone" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="{{ __('language.placeholder_phone_user') }}">
                    </div>
                    <div class="relative">
                        <label for="editNewPassword" class="block text-sm font-semibold text-gray-700">{{ __('language.title_new_password_user') }}</label>
                        <div class="relative">
                            <input type="password" id="editNewPassword" class="w-full p-3 pr-10 border rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="{{ __('language.placeholder_new_password_user') }}">
                            <i class="toggle-password fa fa-eye absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500"></i>
                        </div>
                        <p class="italic text-red-600 text-sm mt-1" id="alert-password"></p>
                    </div>
                </div>

                <!-- Display-only Fields -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">{{ __('language.title_username_user') }}: <span id="editUsername" class="text-blue-600 font-semibold text-sm"></span></label>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">{{ __('language.title_email_user') }}: <span id="editEmail" class="text-blue-600 font-semibold text-sm"></span></label>
                </div>
                
                <!-- Bio -->
                <div>
                    <label for="editBio" class="block text-sm font-semibold text-gray-700">{{ __('language.title_bio_user') }}</label>
                    <textarea id="editBio" class="w-full p-3 border rounded-lg h-28 resize-none focus:ring-2 focus:ring-blue-400" placeholder="{{ __('language.placeholder_bio_user') }}"></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="submit" class="p-3 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-600 hover:shadow-xl active:scale-95 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>

                </div>
                
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin">
</script>

  
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
                { data: 'bio', name: 'bio', render: function(data) {
                    return truncateText(data, 10);
                }  },
                { data: 'full_name', name: 'full_name' },
                { 
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="flex space-x-3">
                            <i onclick="openEditModal(${row.id})" class="fas fa-edit text-blue-500 text-lg cursor-pointer hover:text-blue-600"></i>
                            <i class="delete-btn fas fa-trash-alt text-red-500 text-lg cursor-pointer hover:text-red-600" data-id="${row.id}"></i>
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

            let userId = $("#editUserId").val();
            let new_password = $("#editNewPassword").val();
            let date = $("#editDate").val();
            let phone = $("#editPhone").val();
            let bio = $("#editBio").val();
            let full_name = $("#editFullname").val();
            let profile_picture = document.getElementById('editProfilePic').src;
            let cover_photo = document.getElementById('editCoverPhoto').src;
            let defaultProfilePic = "{{ asset('default_avatar.jpg') }}"; // Đường dẫn ảnh mặc định
            let defaultCoverPhoto = "{{ asset('default_cover_photo.jpg') }}"; // Đường dẫn ảnh mặc định
            if (profile_picture == defaultProfilePic) {
                profile_picture = '';
            }
            if (cover_photo == defaultCoverPhoto) {
                cover_photo = '';
            }
            var alertPassword = '{{ __('language.error_wrong_format_password') }}';
            if (new_password != '' && new_password.length < 8) {
                document.getElementById('alert-password').innerText = alertPassword;
                return;
            }
            $.ajax({
                url: `{{ route('user.update', ':id') }}`.replace(':id', userId),
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    new_password: new_password,
                    date: date,
                    phone: phone,
                    bio: bio,
                    full_name: full_name,
                    profile_picture: profile_picture,
                    cover_photo: cover_photo
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
                        url: `{{ route('user.delete', ':id') }}`.replace(':id', userId),
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
                        url: "{{ route('user.deleteItems') }}",
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
        document.getElementById('alert-password').innerText = '';
        $('#editNewPassword').val('')
        $.ajax({
            url: `{{ route('user.get', ':id') }}`.replace(':id', userId), // Đường dẫn API lấy thông tin
            type: "GET",
            success: function(response) {
                if (response.status === '200') {
                    $("#editUserId").val(response.user.id);
                    $("#editDate").val(response.user.date);
                    $("#editPhone").val(response.user.phone);
                    $("#editBio").val(response.user.bio);
                    $("#editFullname").val(response.user.full_name);
                    $("#editUsername").text(response.user.username);
                    $("#editEmail").text(response.user.email);

                    if (response.user.profile_picture) {
                        let imageUrl = response.user.profile_picture;
                        $("#editProfilePic").attr("src", imageUrl).removeClass("hidden");
                    } else {
                        $("#editProfilePic").attr("src", "/default_avatar.jpg").removeClass("hidden");
                    }

                    if (response.user.cover_photo) {
                        let imageUrl = response.user.cover_photo;
                        $("#editCoverPhoto").attr("src", imageUrl).removeClass("hidden");
                    } else {
                        $("#editCoverPhoto").attr("src", "/default_cover_photo.jpg").removeClass("hidden");
                    }
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

    function openTinyMCEFilePicker(img, input) {
        let cmsurl = '/laravel-filemanager?editor=tinymce5&type=Images'; // Đường dẫn đến file manager
        // Nếu chưa có editor nào, tạo một editor ẩn để kích hoạt file manager

        // Kiểm tra nếu editor ẩn đã tồn tại thì xóa trước
        if (tinymce.get("hiddenEditor")) {
            tinymce.get("hiddenEditor").remove();
        }

        tinymce.init({
            selector: 'textarea#hiddenEditor', // Một textarea ẩn để kích hoạt TinyMCE
            menubar: false,
            toolbar: false,
            statusbar: false,
            setup: function(editor) {
                editor.on('init', function() {
                    // Mở file manager ngay khi editor khởi động
                    editor.windowManager.openUrl({
                        url: cmsurl,
                        title: 'File Manager',
                        width: window.innerWidth * 0.8,
                        height: window.innerHeight,
                        onMessage: (api, message) => {
                            img.src = message.content; // Cập nhật ảnh đại diện
                            input.value = message.content; // Lưu đường dẫn vào input hidden
                            editor.remove(); // Xóa editor sau khi chọn ảnh
                        }
                    });
                });
            }
        });
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
            openTinyMCEFilePicker(profilePic, fileInputProfilePic);
        });

        // Khi nhấn vào ảnh -> mở chọn file
        coverPhotoOverlay.addEventListener("click", function () {
            openTinyMCEFilePicker(coverPhoto, fileInputCoverPhoto);
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("editDate");
        const calendarIcon = document.getElementById("openCalendar");

        // Khởi tạo Flatpickr cho input
        const fp = flatpickr(dateInput, {
            dateFormat: "Y-m-d", // Định dạng ngày tháng
            allowInput: false, // Cho phép nhập tay
            defaultDate: new Date(), // Hiển thị ngày hiện tại
        });

        // Khi click icon thì mở lịch
        calendarIcon.addEventListener("click", function () {
            fp.open();
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        let togglePassword = document.querySelector(".toggle-password");
        togglePassword.addEventListener("click", function () {

            let passwordField = document.getElementById("editNewPassword");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                this.classList.replace("fa-eye-slash", "fa-eye");
            }
        });
    });
</script>
<textarea id="hiddenEditor" style="display: none;"></textarea>
@endsection