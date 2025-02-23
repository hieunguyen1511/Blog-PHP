<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Layout</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-gray-100">

    <!-- Header -->
    @include('layouts.userHeader')


    <!-- Main content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.userFooter')

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Notification popup toggle
        const notificationButton = document.getElementById('notification-button');
        const notificationPopup = document.getElementById('notification-popup');

        notificationButton.addEventListener('click', (e) => {
            e.stopPropagation();
            notificationPopup.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!notificationPopup.contains(e.target) && e.target !== notificationButton) {
                notificationPopup.classList.add('hidden');
            }
        });

        const profileButton = document.getElementById('profile-button');
        const profilePopup = document.getElementById('profile-popup');

        profileButton.addEventListener('click', (e) => {
            e.stopPropagation();
            profilePopup.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!profilePopup.contains(e.target) && e.target !== profileButton) {
                profilePopup.classList.add('hidden');
            }
        });



    </script>
</body>

</html>
