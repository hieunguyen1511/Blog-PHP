@extends('layouts.adminLayout')

@section('content')
<div class="container mx-auto bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-semibold mb-4">{{__('language.title_profile')}}</h2>

    <!-- Nhóm 1: Cài đặt tài khoản -->
    <form class="space-y-4" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center justify-center">
            @if (session('errorProfile'))
                <div id="toast-danger" class="flex items-center w-full max-w-xl p-4 mb-4 text-gray-800 bg-red-100 rounded-lg shadow-sm" role="alert">
                    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                        </svg>
                    </div>
                    <div class="ms-3 text-sm font-bold">{{session('errorProfile')}}</div>
                </div>
            @endif
            @if (session('successProfile'))
                <div id="toast-success" class="flex items-center w-full max-w-xl p-4 mb-4 text-gray-800 bg-green-100 rounded-lg shadow-sm" role="alert">
                    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 6.793a1 1 0 0 0-1.414-1.414L9 9.172 7.707 7.879A1 1 0 0 0 6.293 9.293L9 12l4.707-4.707Z"/>
                        </svg>
                    </div>
                    <div class="ms-3 text-sm font-bold">{{ session('successProfile') }}</div>
                </div>
            @endif
        </div>

        <div class="space-y-6 max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <!-- Ảnh đại diện -->
            <div class="relative flex flex-col items-center">
                <div class="relative w-28 h-28">
                    <img src="{{ $user->profile_picture ?? asset('default_avatar.jpg') }}" 
                        id="editProfilePic" 
                        alt="Profile Picture" 
                        class="w-full h-full rounded-full border-2 border-gray-300 object-cover cursor-pointer">
                    <input type="file" id="fileInputProfilePic" name="profile_picture" accept="image/*" class="hidden">
                    <div id="profilePicOverlay" 
                        class="absolute inset-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer rounded-full">
                        <span class="text-white text-sm font-semibold">{{ __('language.change_picture') }}</span>
                    </div>
                </div>
            </div>
        
            <!-- Ảnh bìa -->
            <div class="relative">
                <img src="{{ $user->cover_photo ?? asset('default_cover_photo.jpg') }}"
                    id="editCoverPhoto" 
                    alt="Cover Photo" 
                    class="w-full h-40 rounded-lg border-2 border-gray-300 object-cover cursor-pointer">
                <input type="file" id="fileInputCoverPhoto" name="cover_photo" accept="image/*" class="hidden">
                <div id="coverPhotoOverlay" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer rounded-lg">
                    <span class="text-white text-sm font-semibold">{{ __('language.change_picture') }}</span>
                </div>
            </div>
        
            <!-- Thông tin cá nhân -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('language.title_email_user') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="block w-full p-2 border border-gray-300 rounded-md">
                    <p class="italic text-red-600 text-sm" id="alert-email"></p>
                </div>
        
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('language.title_full_name_user') }}</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" required class="block w-full p-2 border border-gray-300 rounded-md">
                </div>
            </div>
        
            <!-- Ngày sinh -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('language.title_date_user') }}</label>
                <div class="relative">
                    <input type="text" id="date" name="date" value="{{ old('date', $user->date) }}"
                        class="w-full p-3 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400">
                    <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-lg" id="openCalendar">📅</span>
                </div>
            </div>
        
            <!-- Số điện thoại -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('language.title_phone_user') }}</label>
                <input type="tel" pattern="[0-9]{10}" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full p-3 border border-gray-300 rounded-md">
            </div>
        
            <!-- Tiểu sử -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('language.title_bio_user') }}</label>
                <textarea id="bio" name="bio" rows="4" class="block w-full p-3 border border-gray-300 rounded-lg">{{ old('bio', $user->bio) }}</textarea>
            </div>
        
            <!-- Mật khẩu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700">{{ __('language.title_old_password') }}</label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <input type="password" id="old-password" name="old-password" class="block w-full p-2 rounded-md pr-10">
                        <i id="toggle-old-password" class="fa fa-eye absolute right-3 cursor-pointer"></i>
                    </div>
                </div>
        
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700">{{ __('language.title_new_password_user') }}</label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <input type="password" id="new-password" name="new-password" class="block w-full p-2 pr-10 rounded-md">
                        <i id="toggle-new-password" class="fa fa-eye absolute right-3 cursor-pointer"></i>
                    </div>
                    <p class="italic text-red-600 text-sm" id="alert-new-password"></p>
                </div>
            </div>
        
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">{{ __('language.title_re_new_password') }}</label>
                <div class="flex items-center border border-gray-300 rounded-md">
                    <input type="password" id="re-new-password" name="re-new-password" class="block w-full p-2 rounded-md pr-10">
                    <i id="toggle-re-new-password" class="fa fa-eye absolute right-3 cursor-pointer"></i>
                </div>
                <p class="italic text-red-600 text-sm" id="alert-re-new-password"></p>
            </div>
        
            <!-- Nút lưu -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">{{ __('language.btn_update') }}</button>
            </div>
        </div>
        
        
    </form>
    
</div>

<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin">
</script>
<!-- JavaScript -->
<script>
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
        const dateInput = document.getElementById("date");
        const calendarIcon = document.getElementById("openCalendar");

        // Khởi tạo Flatpickr cho input
        const fp = flatpickr(dateInput, {
            dateFormat: "Y-m-d", // Định dạng ngày tháng
            allowInput: false, // Cho phép nhập tay
            defaultDate: document.getElementById("date").value || new Date(), // Hiển thị ngày hiện tại
        });

        // Khi click icon thì mở lịch
        calendarIcon.addEventListener("click", function () {
            fp.open();
        });
    });
    
    document.addEventListener("DOMContentLoaded", function () {
        let toggleOldPassword = document.getElementById("toggle-old-password");
        let toggleNewPassword = document.getElementById("toggle-new-password");
        let toggleReNewPassword = document.getElementById("toggle-re-new-password");
        toggleNewPassword.addEventListener("click", function () {

            let passwordField = document.getElementById("new-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                this.classList.replace("fa-eye-slash", "fa-eye");
            }
        });
        toggleReNewPassword.addEventListener("click", function () {
            let passwordField = document.getElementById("re-new-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                this.classList.replace("fa-eye-slash", "fa-eye");
            }
         });
         toggleOldPassword.addEventListener("click", function () {
            let passwordField = document.getElementById("old-password");
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
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        const full_name = document.getElementById('full_name').value;
        const email = document.getElementById('email').value;
        const old_password = document.getElementById('old-password').value;
        const new_password = document.getElementById('new-password').value;
        const re_new_password = document.getElementById('re-new-password').value;
        var date = document.getElementById('date').value;
        var bio = document.getElementById('bio').value;
        var phone = document.getElementById('phone').value;
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
        
        var alertEmail = '{{ __('language.email_alert') }}';
        var alertPassword1 = '{{ __('language.error_wrong_format_password') }}';
        var alertPassword2 = '{{ __('language.error_not_match_repassword') }}';
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        var valid = true;
        if (!emailRegex.test(email)) {
            document.getElementById('alert-email').innerText = alertEmail;
            valid = false;
        } 
        else {
            document.getElementById('alert-email').innerText = '';
        }
        if (new_password != '') {
            if (new_password.length < 8) {
                document.getElementById('alert-new-password').innerText = alertPassword1;
                valid = false;
            }
            else {
                document.getElementById('alert-new-password').innerText = '';
                if (new_password !== re_new_password) {
                    document.getElementById('alert-re-new-password').innerText = alertPassword2;
                    valid = false;
                }
                else {
                    document.getElementById('alert-re-new-password').innerText = '';
                }
            }  
        } 
        if (valid) {
            $.ajax({
                url: `{{ route('profile.update', session('userid')) }}`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    full_name: full_name,
                    email: email,
                    old_password: old_password,
                    new_password: new_password,
                    date: date,
                    bio: bio,
                    phone: phone,
                    profile_picture: profile_picture,
                    cover_photo: cover_photo
                },
                success: function (response) {
                    if (response.status === '200') {
                        $("#old-password").val('');
                        $("#new-password").val('');
                        $("#re-new-password").val('');
                        if (profile_picture != '') {
                            document.getElementById('profile_photo-sidebar').src = profile_picture;
                            document.getElementById('full_name-sidebar').innerText = full_name;
                        }
                        toastr.success(response.message, "{{ __('language.message_success') }}", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000,
                            positionClass: 'toast-top-right',
                        });
                    } else {
                        toastr.error(response.message, "{{ __('language.message_fail') }}", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000,
                            positionClass: 'toast-top-right',
                        });
                    }
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON?.message || "{{ __('language.unknown_error') }}", "{{ __('language.message_fail') }}", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,
                        positionClass: 'toast-top-right',
                    });
                }
            });
        }
    });
</script>

<textarea id="hiddenEditor" style="display: none;"></textarea>
@endsection
