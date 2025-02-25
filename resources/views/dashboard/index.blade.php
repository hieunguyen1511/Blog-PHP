@extends('layouts.adminLayout')
@section('content')
    {{-- <div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>
    
    <!-- Tổng quan -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Tổng số bài viết</h2>
            <p class="text-2xl font-bold"></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Tổng số bài thảo luận</h2>
            <p class="text-2xl font-bold"></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Tổng số bình luận</h2>
            <p class="text-2xl font-bold"></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Tổng số người dùng</h2>
            <p class="text-2xl font-bold"></p>
        </div>
    </div>

    <!-- Thống kê & Báo cáo -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Thống kê & Báo cáo</h2>
        <canvas id="postsChart"></canvas>
    </div>
</div> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<main class="flex-1 p-4 lg:p-8 overflow-x-hidden">
    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{__('language.total_users')}}</h2>
                    <p id="total-users" class="text-2xl font-semibold text-gray-800 dark:text-white">0</p>
                    <p class="text-green-500 text-sm font-medium mt-1">+<span id="percent-increase-users"></span>% {{__('language.from_last_month')}}</p>
                </div>
            </div>
        </div>

        <!-- Total Posts Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{__('language.total_posts')}}</h2>
                    <p id="total-posts" class="text-2xl font-semibold text-gray-800 dark:text-white">0</p>
                    <p class="text-green-500 text-sm font-medium mt-1">+<span id="percent-increase-posts"></span>% {{__('language.from_last_month')}}</p>
                </div>
            </div>
        </div>

        <!-- Total Views Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{__('language.total_views')}}</h2>
                    <p id="total-views" class="text-2xl font-semibold text-gray-800 dark:text-white">0</p>
                    <p class="text-green-500 text-sm font-medium mt-1"><div class="h-5"></div></p>
                </div>
            </div>
        </div>

        <!-- Total Comments Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{__('language.total_comments')}}</h2>
                    <p id="total-comments" class="text-2xl font-semibold text-gray-800 dark:text-white">0</p>
                    <p class="text-green-500 text-sm font-medium mt-1">+<span id="percent-increase-comments"></span>% {{__('language.from_last_month')}}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 mb-8">
        

        <!-- Published Posts Statistics -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{__('language.published_posts_statistics')}}</h3>
                    <div class="flex items-center space-x-2">
                        <button onclick="updatePostStats('week')"
                            class="px-3 py-1 text-sm rounded-md bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300">{{__('language.week')}}</button>
                        <button onclick="updatePostStats('month')"
                            class="px-3 py-1 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">{{__('language.month')}}</button>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <canvas id="postsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Charts Section -->
    <div class="grid grid-cols-1 mb-8">
        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{__('language.recent_activity')}}</h3>
            </div>
            <div class="p-6">
                <div class="space-y-6" id="recent-activity">
                    {{-- <!-- Activity Item 1 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe"
                                alt="John Doe">
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">John Doe</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">5 min ago</p>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Published a new post: "Getting Started
                                with Laravel"</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 mt-2">New
                                Post</span>
                        </div>
                    </div>

                    <!-- Activity Item 2 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Sarah+Smith"
                                alt="Sarah Smith">
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Sarah Smith</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">15 min ago</p>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Commented on "Vue.js Best Practices"
                            </p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 mt-2">Comment</span>
                        </div>
                    </div>

                    <!-- Activity Item 3 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Mike+Johnson"
                                alt="Mike Johnson">
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Mike Johnson</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">1 hour ago</p>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Updated their profile information</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 mt-2">Profile
                                Update</span>
                        </div>
                    </div>

                    <!-- Activity Item 4 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Emily+Brown"
                                alt="Emily Brown">
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Emily Brown</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">2 hours ago</p>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Created a new category: "Web
                                Development"</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 mt-2">New
                                Category</span>
                        </div>
                    </div> --}}
                </div>

                <!-- View All Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('notification.index') }}"
                        class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                        {{__('language.view_all_activity')}} →
                    </a>
                </div>
            </div>
        </div>

        {{-- <!-- Latest Records Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Latest Records</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Date</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Table rows go here -->
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>


    {{-- <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');

            // Prevent body scroll when sidebar is open
            document.body.classList.toggle('overflow-hidden');
        }

        function toggleNotifications() {
            const dropdown = document.getElementById('notifications-dropdown');
            dropdown.classList.toggle('hidden');

            // Close profile dropdown if open
            document.getElementById('profile-dropdown').classList.add('hidden');
        }

        function toggleProfileMenu() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('hidden');

            // Close notifications dropdown if open
            document.getElementById('notifications-dropdown').classList.add('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const notificationsButton = document.querySelector('[onclick="toggleNotifications()"]');
            const profileButton = document.querySelector('[onclick="toggleProfileMenu()"]');
            const notificationsDropdown = document.getElementById('notifications-dropdown');
            const profileDropdown = document.getElementById('profile-dropdown');

            if (!notificationsButton.contains(event.target) && !notificationsDropdown.contains(event.target)) {
                notificationsDropdown.classList.add('hidden');
            }

            if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('darkMode', isDark);
        }

        function changeLanguage(locale) {
            window.location.href = `/language/${locale}`;
        }

        // Initialize dark mode from stored preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElem ent.classList.add('dark');
        }
    </script> --}}


    <!-- Add before closing body tag -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let language = @json(__('language'));
            $.ajax({
                url: "{{ route('dashboard.getTotalUsers') }}",
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == '200') {
                        document.getElementById('total-users').innerHTML = response.total;
                        document.getElementById('percent-increase-users').innerHTML = response.percent_increase;
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

            $.ajax({
                url: "{{ route('dashboard.getTotalPosts') }}",
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == '200') {
                        document.getElementById('total-posts').innerHTML = response.total;
                        document.getElementById('percent-increase-posts').innerHTML = response.percent_increase;
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
            $.ajax({
                url: "{{ route('dashboard.getTotalViews') }}",
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == '200') {
                        document.getElementById('total-views').innerHTML = formatViews(response.total);
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

            $.ajax({
                url: "{{ route('dashboard.getTotalComments') }}",
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == '200') {
                        document.getElementById('total-comments').innerHTML = formatViews(response.total);
                        document.getElementById('percent-increase-comments').innerHTML = formatViews(response.percent_increase);
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

            $.ajax({
                url: "{{ route('dashboard.getPublishedPostsStatistics') }}",
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == '200') {
                        // Initialize Posts Chart - Only Published Posts
                        var labelDayofweeks = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                        var translatedLabelDayofweeks = labelDayofweeks.map(label => language[label]);
                        var translatedLabelWeekly = [];
                        for (var i = 0; i < response.weeks_count; i++) {
                            translatedLabelWeekly[i] = language['week'] + ' ' + (i + 1);
                        }
                        const postsCtx = document.getElementById('postsChart').getContext('2d');
                        const postsChart = new Chart(postsCtx, {
                            type: 'bar',
                            data: {
                                labels: translatedLabelDayofweeks,
                                datasets: [{
                                    label: language['published_posts'],
                                    data: response.weekly_posts,
                                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                    borderWidth: 1,
                                    borderRadius: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return `${language['count_published_posts']}: ${context.parsed.y}`;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: language['count_published_posts']
                                        }
                                    }
                                }
                            }
                        });

                        // Update functions
                        window.updatePostStats = function(period) {
                            const data = {
                                week: {
                                    labels: translatedLabelDayofweeks,
                                    data: response.weekly_posts,
                                },
                                month: {
                                    labels: translatedLabelWeekly,
                                    data: response.weeks_data,
                                }
                            };

                            postsChart.data.labels = data[period].labels;
                            postsChart.data.datasets[0].data = data[period].data;
                            postsChart.update();

                            // Update button styles
                            document.querySelectorAll('[onclick^="updatePostStats"]').forEach(button => {
                                button.classList.remove('bg-blue-100', 'text-blue-600', 'dark:bg-blue-900',
                                    'dark:text-blue-300');
                                button.classList.add('hover:bg-gray-100', 'dark:hover:bg-gray-700');
                            });
                            event.target.classList.remove('hover:bg-gray-100', 'dark:hover:bg-gray-700');
                            event.target.classList.add('bg-blue-100', 'text-blue-600', 'dark:bg-blue-900',
                                'dark:text-blue-300');
                        };

                        // window.updateChartData = function(period) {
                        //     // Add your analytics update logic here
                        //     console.log('Updating analytics chart:', period);
                        // };





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
            $.ajax({
                url: "{{ route('dashboard.getRecentActivity') }}",
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == '200') {
                        inner = ``;
                        var keys = response.array_notification_types;
                        var translatedMessages = keys.map(key => language[key]);
                        response.last_notification.forEach(element => {
                            var message = translatedMessages[element.noti_type_code]
                            if (element.noti_type_code == 0) {
                                message += ` "${element.content}"`;
                            }
                            inner += `
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="${element.user.profile_picture ?? '/default_avatar.jpg'}" alt="${element.user.full_name}">
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">${element.user.full_name}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">${element.created_at}</p>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">${message}</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 mt-2">
                                            ${element.noti_type_name}
                                        </span>
                                    </div>
                                </div>
                            `
                        });
                        document.getElementById('recent-activity').innerHTML = inner;
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
        function formatViews(num) {
            if (num >= 1_000_000_000) {
                return (num / 1_000_000_000).toFixed(1) + 'B'; // Tỷ
            } else if (num >= 1_000_000) {
                return (num / 1_000_000).toFixed(1) + 'M'; // Triệu
            } else if (num >= 1_000) {
                return (num / 1_000).toFixed(1) + 'K'; // Nghìn
            }
            return num; // Giữ nguyên nếu nhỏ hơn 1000
        }


    </script>
    
@endsection
