@extends('layouts.adminLayout')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold mb-4">{{__('language.sidebar_settings')}}</h2>

    <!-- Nhóm 1: Cài đặt tài khoản -->
    <form id="settingsForm" action="{{ route('setting.update') }}" method="post" class="space-y-4">
        @csrf
        <h3 class="text-xl font-medium mb-2">{{__('language.title_authentication_user_setting')}}</h3>
        <div class="flex items-center justify-center">
            @if (session('errorSetting'))
                <div id="toast-danger" class="flex items-center w-full max-w-xl p-4 mb-4 text-gray-800 bg-red-100 rounded-lg shadow-sm" role="alert">
                    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                    </svg>
                        <span class="sr-only">Error icon</span>
                    </div>
                    <div class="ms-3 text-sm font-bold">{{session('errorSetting')}}</div>
            </div>
            @endif
            @if (session('successSetting'))
                <div id="toast-success" class="flex items-center w-full max-w-xl p-4 mb-4 text-gray-800 bg-green-100 rounded-lg shadow-sm" role="alert">
                    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 6.793a1 1 0 0 0-1.414-1.414L9 9.172 7.707 7.879A1 1 0 0 0 6.293 9.293L9 12l4.707-4.707Z"/>
                        </svg>
                        <span class="sr-only">Success icon</span>
                    </div>
                    <div class="ms-3 text-sm font-bold">{{ session('successSetting') }}</div>
                </div>
            @endif



        </div>

        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
            </div>
            <input type="email" id="email" name="email" value="{{ old('email', $email) }}" placeholder="{{ __('language.placeholder_email') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <p class="italic text-red-600 text-sm" id="alert-email"></p>
        <div class="relative">
            <!-- Icon bên trái -->
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </div>
        
            <!-- Input -->
            <input type="password" id="password" name="password" placeholder="{{ __('language.placeholder_password') }}"
                   class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        
            <!-- Icon bên phải để toggle password -->
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <i class="fas fa-eye cursor-pointer text-gray-500 toggle-password"></i>
            </div>
        </div>
        <p class="italic text-red-600 text-sm" id="alert-password"></p>
        <div id="alert-had-password">
            @if ($hadPassword != null)
                <div class="flex items-center p-3 text-green-700 bg-green-100 rounded-lg shadow-md">
                    <svg class="w-5 h-5 mr-2 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-medium">Đã có mật khẩu</p>
                </div>
            @else
                <div class="flex items-center p-3 text-red-700 bg-red-100 rounded-lg shadow-md">
                    <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-14a6 6 0 100 12A6 6 0 0010 4zm1 3a1 1 0 10-2 0v4a1 1 0 002 0V7zm-1 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-medium">Chưa có mật khẩu</p>
                </div>
            @endif
        </div>


        <button type="submit" class="bg-blue-500 text-white px-8 py-2 text-lg rounded-lg hover:bg-blue-600">
            {{ __('language.btn_update') }}
        </button>
        
    </form>
</div>

<!-- JavaScript -->
<script>
    $(document).ready(function () {
        $("#settingsForm").submit(function (event) {
            event.preventDefault(); // Ngăn form submit mặc định
            const email = document.getElementById('email').value;
            var alertEmail = '{{ __('language.email_alert') }}';
            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            var password = document.getElementById('password').value;
            let valid = true;
            if (email.trim() != '' && !emailRegex.test(email)) {
                event.preventDefault();
                document.getElementById('alert-email').innerText = alertEmail;
                valid = false;
            } 
            else {
                document.getElementById('alert-email').innerText = '';
            }
            if (valid) {
                let formData = {
                    _token: "{{ csrf_token() }}",
                    email: $("#email").val(),
                    password: $("#password").val(),
                };

                $.ajax({
                    url: "{{ route('setting.update') }}",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        if (response.status === '200') {
                            $("#password").val('');
                            if (password != '') {
                                $("#alert-had-password").html(`
                                    <div class="flex items-center p-3 text-green-700 bg-green-100 rounded-lg shadow-md">
                                        <svg class="w-5 h-5 mr-2 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-sm font-medium">Đã có mật khẩu</p>
                                    </div>
                                `);
                            }
                            else {
                                $("#alert-had-password").html(`
                                    <div class="flex items-center p-3 text-red-700 bg-red-100 rounded-lg shadow-md">
                                        <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-14a6 6 0 100 12A6 6 0 0010 4zm1 3a1 1 0 10-2 0v4a1 1 0 002 0V7zm-1 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-sm font-medium">Chưa có mật khẩu</p>
                                    </div>
                                `);
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
    });
    document.addEventListener("DOMContentLoaded", function () {
        let togglePassword = document.querySelector(".toggle-password");
        togglePassword.addEventListener("click", function () {

            let passwordField = document.getElementById("password");
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

@endsection
