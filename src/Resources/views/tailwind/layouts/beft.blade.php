<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BEFT Panel')</title>

    <!-- Tailwind CSS CDN (for demo) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- Additional CSS -->
    @stack('styles')

    <style>
        #showToast {
            display: none;
            padding: 10px;
            color: white;
            background-color: green;
            text-align: center;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .error-title, .error-subtitle {
            color: red;
        }

        /* Toggle switch */
        .switch-input {
            display: none;
        }

        .switch-label {
            display: inline-block;
            width: 50px;
            height: 25px;
            background: #ccc;
            border-radius: 25px;
            position: relative;
            cursor: pointer;
        }

        .switch-label::after {
            content: '';
            width: 21px;
            height: 21px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: 0.3s;
        }

        .switch-input:checked + .switch-label::after {
            transform: translateX(25px);
        }

        .switch-input:checked + .switch-label {
            background: #3b82f6; /* Tailwind blue-500 */
        }
    </style>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex justify-between items-center h-16 p-2">
            <a href="{{ url('beft') }}" class="font-bold text-lg">BEFT Panel</a>

            <!-- Hamburger for mobile -->
            <div class="md:hidden">
                <button id="mobileMenuButton" class="focus:outline-none">
                    <iconify-icon icon="mdi:menu" width="28" height="28"></iconify-icon>
                </button>
            </div>

            <div id="navbarMenu" class="hidden md:flex md:items-center space-x-4 me-5">
                <a href="{{ url('beft/custom-pages') }}" class="px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('beft/custom-pages*') ? 'bg-gray-900' : '' }}">
                    Custom Pages
                </a>

                <div class="relative group">
                    <button class="px-3 py-2 rounded hover:bg-gray-700 flex items-center space-x-1">
                        <span>Settings</span>
                        <iconify-icon icon="mdi:chevron-down" width="16" height="16"></iconify-icon>
                    </button>
                    <ul class="absolute left-0 mt-1 bg-white text-gray-800 rounded shadow-md hidden group-hover:block min-w-[200px] z-10">
                        <li><a class="block px-4 py-2 hover:bg-gray-200" href="{{ url('beft/settings') }}">System Settings</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-200" href="{{ url('beft/footer-settings') }}">Footer Settings</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-200" href="{{ url('beft/site-settings') }}">Site Settings</a></li>
                        <li><hr class="border-t my-1"></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-200" href="{{ url('beft/settings/login') }}">Auth Page Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="max-w-7xl mx-auto py-6 px-4">
    @yield('content')
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<!-- Mobile menu toggle -->
<script>
    const mobileButton = document.getElementById('mobileMenuButton');
    const navbarMenu = document.getElementById('navbarMenu');

    mobileButton.addEventListener('click', () => {
        navbarMenu.classList.toggle('hidden');
    });
</script>

@stack('scripts')
</body>
</html>
