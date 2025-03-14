<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('language.title_register') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-lg shadow-md p-8 w-full max-w-md">
        <!-- Heading -->
        <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">
            {{ __('language.title_register') }}
        </h1>
        <!-- Registration Form -->
        <form class="space-y-4" method="post" action="{{ route('registerUser') }}">
            @csrf
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" name="fullname" value="{{old('fullname')}}" required placeholder="{{ __('language.placeholder_fullname') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <input type="email" name="email" value="{{old('email')}}" required placeholder="{{ __('language.placeholder_email') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" name="username" value="{{old('username')}}" required placeholder="{{ __('language.placeholder_username') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="password" id="password"  name="password" required placeholder="{{ __('language.placeholder_password') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <button type="button"
                class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500"
                onclick="togglePassword('password', this)">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" class="eye-path"></path>
                    <circle cx="12" cy="12" r="3" class="eye-circle"></circle>
                    <line x1="2" y1="2" x2="22" y2="22" class="eye-line"></line>
                </svg>
            </button>
            </div>
            <p class="italic text-red-600 text-sm" id="alert-password-1">

            </p>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="password" id="re-password" name="re-password" required placeholder="{{ __('language.placeholder_repassword') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <button type="button"
                class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500"
                onclick="togglePassword('re-password', this)">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" class="eye-path"></path>
                    <circle cx="12" cy="12" r="3" class="eye-circle"></circle>
                    <line x1="2" y1="2" x2="22" y2="22" class="eye-line"></line>
                </svg>
            </button>
            </div>
            <p class="italic text-red-600 text-sm" id="alert-password-2">

            </p>
            <!-- Register Button -->
            <button type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('language.btn_register') }}
            </button>
        </form>

        <!-- Divider -->
        <div class="mt-6 relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">
                    {{ __('language.title_register_with') }}
                </span>
            </div>
        </div>

        <!-- Social Login -->
        <div class="mt-6 grid grid-cols-2 gap-3">
            <button
                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20.3081 10.2303C20.3081 9.55056 20.253 8.86711 20.1354 8.19836H10.7031V12.0492H16.1046C15.8804 13.2911 15.1602 14.3898 14.1057 15.0879V17.5866H17.3282C19.2205 15.8449 20.3081 13.2728 20.3081 10.2303Z"
                        fill="#3F83F8" />
                    <path
                        d="M10.7019 20.0006C13.3989 20.0006 15.6734 19.1151 17.3306 17.5865L14.1081 15.0879C13.2115 15.6979 12.0541 16.0433 10.7056 16.0433C8.09669 16.0433 5.88468 14.2832 5.091 11.9169H1.76562V14.4927C3.46322 17.8695 6.92087 20.0006 10.7019 20.0006V20.0006Z"
                        fill="#34A853" />
                    <path
                        d="M5.08857 11.9169C4.66969 10.6749 4.66969 9.33008 5.08857 8.08811V5.51233H1.76688C0.348541 8.33798 0.348541 11.667 1.76688 14.4927L5.08857 11.9169V11.9169Z"
                        fill="#FBBC04" />
                    <path
                        d="M10.7019 3.95805C12.1276 3.936 13.5055 4.47247 14.538 5.45722L17.393 2.60218C15.5852 0.904587 13.1858 -0.0287217 10.7019 0.000673888C6.92087 0.000673888 3.46322 2.13185 1.76562 5.51234L5.08732 8.08813C5.87733 5.71811 8.09302 3.95805 10.7019 3.95805V3.95805Z"
                        fill="#EA4335" />
                </svg>
                Google
            </button>

            <button
                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-blue-500 hover:bg-gray-50">
                <svg class="w-5 h-5 mr-2 " fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z"
                        clip-rule="evenodd" />
                </svg>
                Facebook
            </button>
        </div>

        <!-- Login Link -->
        <div class="mt-6 text-center">
            <span class="text-sm text-gray-600">{{ __('language.have_account') }} </span>
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-500">
                {{ __('language.login') }}
            </a>
        </div>
    </div>
</body>

</html>

<script>
    function togglePassword(fieldId, button) {
        const field = document.getElementById(fieldId);
        const svg = button.querySelector("svg");
        const line = svg.querySelector(".eye-line");

        if (field.type === "password") {
            field.type = "text";
            line.style.display = "none";
        } else {
            field.type = "password";
            line.style.display = "block";
        }
    }
    document.querySelector('form').addEventListener('submit', function (event) {
        const password = document.getElementById('password').value;
        const rePassword = document.getElementById('re-password').value;
        var alertPassword1 = '{{ __('language.error_wrong_format_password') }}';
        var alertPassword2 = '{{ __('language.error_not_match_repassword') }}';
        console.log(password);
        console.log(rePassword);
        if (password.length < 8) {
            event.preventDefault();
            document.getElementById('alert-password-1').innerText = alertPassword1;
        } else {
            document.getElementById('alert-password-1').innerText = '';
            if (password !== rePassword) {
                event.preventDefault();
                document.getElementById('alert-password-2').innerText = alertPassword2;
            } else {
                document.getElementById('alert-password-2').innerText = '';
            }
        }
    });
</script>
