<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 flex items-center">
        <svg class="w-7 h-7 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        {{ __('language.setting_change_password') }}
    </h1>

    <form id="form_change_password_submit" class="space-y-6" method="POST" action="{{ route('change_password_submit') }}">
        @csrf
        <div class="grid grid-cols-1 gap-6 mt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('language.setting_change_password_current') }}
                </label>
                <div class="relative">
                    <input required type="password"
                        class="mt-1 py-2 px-3 block w-full h-12 rounded-md border-gray-400 shadow-md focus:border-blue-500 focus:ring-blue-500"
                        id="current_password" name="current_password">
                    <button type="button"
                        class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500"
                        onclick="togglePassword('current_password', this)">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" class="eye-path"></path>
                            <circle cx="12" cy="12" r="3" class="eye-circle"></circle>
                            <line x1="2" y1="2" x2="22" y2="22" class="eye-line"></line>
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('language.setting_change_password_new') }}
                </label>
                <div class="relative">
                    <input required type="password"
                        class="mt-1 py-2 px-3 block w-full h-12 rounded-md border-gray-400 shadow-md focus:border-blue-500 focus:ring-blue-500"
                        id="new_password" name="new_password">
                    <button type="button"
                        class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500"
                        onclick="togglePassword('new_password', this)">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" class="eye-path"></path>
                            <circle cx="12" cy="12" r="3" class="eye-circle"></circle>
                            <line x1="2" y1="2" x2="22" y2="22" class="eye-line"></line>
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('language.setting_change_password_confirm') }}
                </label>
                <div class="relative">
                    <input required type="password" id="confirm_password"
                        class="mt-1 py-2 px-3 block w-full h-12 rounded-md border-gray-400 shadow-md focus:border-blue-500 focus:ring-blue-500"
                        id="confirm_password" name="confirm_password">
                    <button type="button"
                        class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500"
                        onclick="togglePassword('confirm_password', this)">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" class="eye-path"></path>
                            <circle cx="12" cy="12" r="3" class="eye-circle"></circle>
                            <line x1="2" y1="2" x2="22" y2="22" class="eye-line"></line>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div>
            <label id="error_password" class="block text-sm font-medium text-red-500 mb-2">
                @if (session('change_password_error'))
                    {{ session('change_password_error') }}
                @endif
            </label>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit"
                class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md">
                {{ __('language.setting_change_password_save') }}
            </button>
        </div>
    </form>
</div>

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
    document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
        e.preventDefault();
        const currentPassword = document.getElementById('current_password').value;
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        if (newPassword.length < 8) {
            document.getElementById('error_password').textContent =
                '{{ __('language.setting_change_password_alert_new_password') }}';
        } else {
            if (newPassword !== confirmPassword) {
                document.getElementById('error_password').textContent =
                    '{{ __('language.setting_change_password_alert_confirm_password') }}';
            } else {
                document.getElementById('error_password').textContent = '';
                //console.log(currentPassword);
                document.getElementById('form_change_password_submit').submit();
            }
        }

    });
</script>
