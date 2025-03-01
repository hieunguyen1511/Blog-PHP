<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 flex items-center">
        <svg class="w-7 h-7 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        Edit Profile
    </h1>

    <form method="POST" class="space-y-6">
        <div class="grid grid-cols-4 w-full h-full items-center space-x-6">
            <!-- Profile Picture -->
            <div class="col-span-1  h-full flex justify-center">
                <div class="relative">
                    <img id="profile-img" class="h-64 w-64 rounded-lg object-cover border-4 border-white shadow-lg"
                        src="https://images.unsplash.com/photo-1707343843437-caacff5cfa74" alt="Current profile photo">
                    <div class="relative inset-x-0 m-20 mt-10 flex justify-center">
                        <button id="lfm-btn-avatar" type="button" class="px-5 py-3 bg-white text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md">
                            Change Photo
                        </button>
                    </div>
                </div>
                <input type="hidden" id="profile-photo-url" name="profile_photo_url">
            </div>
            <!-- Cover Photo -->
            <div class="col-span-3 h-full rounded-lg">
                <img id="cover-img" src="https://images.unsplash.com/photo-1707343843437-caacff5cfa74"
                    alt="Cover photo" class="h-64 object-cover w-full">
                <div class="relative inset-x-0 m-20 mt-10 flex justify-center">
                    <button id="lfm-btn-cover" type="button" class="px-5 py-3 bg-white text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md">
                        Change Cover Photo
                    </button>
                </div>
                <input type="hidden" id="cover-photo-url" name="cover_photo_url">
            </div>

        </div>

        <!-- Basic Information -->
        <div class="grid grid-cols-1 gap-6 mt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" id="full_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="full_name">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                <textarea rows="4" id="bio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="bio"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                <input datepicker id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="date">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="tel" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="phone">
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end mt-6">
            <button type="submit" class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md">
                Save Changes
            </button>
        </div>
    </form>
</div>

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('lfm-btn-avatar').addEventListener('click', function() {
            var route_prefix = "/laravel-filemanager";
            window.open(route_prefix + '?type=image', 'FileManager', 'width=900,height=600,titlebar=no,menubar=no,toolbar=no,location=no');
            window.SetUrl = function(url) {
                //console.log("Selected image URL:", url[0].url);
                document.getElementById('profile-img').src = url[0].url;
                document.getElementById('profile-photo-url').value = url[0].url;

            };
        });
        document.getElementById('lfm-btn-cover').addEventListener('click', function() {
            var route_prefix = "/laravel-filemanager";
            window.open(route_prefix + '?type=image', 'FileManager', 'width=900,height=600');
            window.SetUrl = function(url) {
            //console.log("Selected image URL:", url[0].url);
            document.getElementById('cover-img').src = url[0].url;
            document.getElementById('cover-photo-url').value = url[0].url;

        };
        });

    });
</script>