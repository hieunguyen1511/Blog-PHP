<!-- Main Content Area -->
<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 flex items-center">
        <svg class="w-7 h-7 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
            </path>
        </svg>
        {{ __('language.setting_favorite_post') }}
    </h1>
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">

        <div class="flex flex-wrap gap-3 w-full sm:w-auto">
            <div class="relative inline-block text-left">
                <button type="button" onclick="toggleDropdown('filterMenu')"
                    class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                    {{ __('language.setting_my_post_filter') }}
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="filterMenu"
                    class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <label class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                            role="menuitem">
                            <input value="0" onclick="checkallFilter()" type="checkbox"
                                class="form-checkbox h-4 w-4 text-blue-600 mr-2" onclick="event.stopPropagation()">
                            {{ __('language.setting_my_post_filter_all') }}
                        </label>
                        @foreach ($total_category as $item)
                            <label class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem">
                                <input value="{{ $item['id'] }}" type="checkbox"
                                    class="form-checkbox h-4 w-4 text-blue-600 mr-2" onclick="event.stopPropagation()">
                                {{ $item['name'] }}
                            </label>
                        @endforeach
                        <div class="border-t border-gray-100"></div>
                        <button type="button" onclick="applyFilter()"
                            class="flex justify-center w-full text-left px-4 py-2 text-sm text-blue-700 hover:bg-blue-100 hover:text-blue-900"
                            role="menuitem">
                            {{ __('language.setting_my_post_filter_apply') }}
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Posts Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('language.setting_my_post_title') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('language.setting_my_post_category') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('language.setting_my_post_action') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($like_posts as $item)
                    <!-- Post {ID} -->
                    <tr class="hover:bg-gray-50">
                        <td id="post_with_category_{{ $item->post->category_id }}" class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">

                                <div class="ml-2">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->post->title }}</div>
                                    <div class="text-sm text-gray-500 truncate max-w-xs">
                                        {{ Str::limit($item->post->description, 40, '...') }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $item->post->category->name }}</span>
                        </td>
                      
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('post-detail', ['link' => $item->post->link]) }}"
                                    class="text-blue-600 hover:text-blue-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                              
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    {{ $like_posts->links() }}
</div>

<script>
    function toggleDropdown(menuId) {
        const menu = document.getElementById(menuId);
        menu.classList.toggle('hidden');
    }

    function applyFilter() {
        // Get all checked categories
        const checkedCategories = Array.from(document.querySelectorAll('#filterMenu input[type="checkbox"]:checked'))
            .map(checkbox => checkbox.value);

        console.log('Applying filter for categories:', checkedCategories);
        const posts = document.querySelectorAll('tbody tr');
        posts.forEach(post => {
            post.classList.add('hidden');
        });
        for (let i = 0; i < checkedCategories.length; i++) {
            const categoryId = checkedCategories[i];
            const posts = document.querySelectorAll(`#post_with_category_${categoryId}`);
            posts.forEach(post => {
                post.closest('tr').classList.remove('hidden');
            });
        }
        // Close the dropdown after applying the filter
        document.getElementById('filterMenu').classList.add('hidden');
    }

    function checkallFilter() {
        const checked = document.getElementById('filterMenu').querySelector('input[type="checkbox"]').checked;
        const checkboxes = document.querySelectorAll('#filterMenu input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = checked;
        });
    }


    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.relative.inline-block')) {
            var dropdowns = document.getElementsByClassName("origin-top-right");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('hidden')) {
                    openDropdown.classList.add('hidden');
                }
            }
        }
    });
</script>
