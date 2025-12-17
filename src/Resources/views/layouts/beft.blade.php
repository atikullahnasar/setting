<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BEFT Panel')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background: #0d6efd;
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('beft') }}">BEFT Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('beft/custom-pages*') ? 'active' : '' }}" href="{{ url('beft/custom-pages') }}">
                        Custom Pages
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('beft/footer-settings*') || request()->is('beft/homepage-settings*') || request()->is('beft/settings*') ? 'active' : '' }}" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Settings
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                        <li><a class="dropdown-item" href="{{ url('beft/homepage-settings') }}">System Settings</a></li>
                        <li><a class="dropdown-item" href="{{ url('beft/footer-settings') }}">Footer Settings</a></li>
                        <li><a class="dropdown-item" href="{{ url('beft/site-settings') }}">Site Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('beft/settings/login') }}">Auth Page Settings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container py-4">
    @yield('content')
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

@stack('scripts')
</body>
</html>
