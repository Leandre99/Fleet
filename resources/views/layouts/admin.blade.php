<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Fleet Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    
    <style>
        body {
            background-color: #f4f7f6;
        }
        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background: #1a1a1a;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #008751;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li a {
            padding: 15px 25px;
            display: block;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: 0.3s;
        }
        #sidebar ul li a:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
            padding-left: 35px;
        }
        #sidebar ul li.active > a {
            color: #fff;
            background: #008751;
            border-left: 5px solid #2ecc71;
        }
        #content {
            width: 100%;
            padding: 40px;
        }
        .admin-nav {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 15px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 class="mb-0 fw-bold">Fleet Admin</h4>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('admin.drivers') ? 'active' : '' }}">
                    <a href="{{ route('admin.drivers') }}"><i class="bi bi-people me-2"></i> Chauffeurs</a>
                </li>
                <li class="{{ request()->routeIs('admin.clients') ? 'active' : '' }}">
                    <a href="{{ route('admin.clients') }}"><i class="bi bi-person me-2"></i> Clients</a>
                </li>
                <li class="{{ request()->routeIs('admin.rides') ? 'active' : '' }}">
                    <a href="{{ route('admin.rides') }}"><i class="bi bi-geo-alt me-2"></i> Courses</a>
                </li>
                <hr class="mx-3 border-secondary">
                <li>
                    <a href="{{ route('profile.edit') }}"><i class="bi bi-person-gear me-2"></i> Mon Profil</a>
                </li>
                <li>
                    <a href="/"><i class="bi bi-house me-2"></i> Retour au site</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <div class="admin-nav d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">@yield('page_title', 'Vue d\'ensemble')</h5>
                <div class="dropdown">
                    <a class="text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
