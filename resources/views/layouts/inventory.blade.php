<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    
    @yield('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand" style="margin-bottom: 2rem; font-size: 1.5rem; font-weight: 700;">
                <i class="fas fa-boxes-stacked"></i> INV-MGT
            </div>
            
            <nav>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('items.index') }}" class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> Items List
                </a>
                @endif
                
                <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt"></i> Transactions
                </a>
                
                <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice"></i> Reports
                </a>
            </nav>
            
            <div style="margin-top: auto; padding-top: 2rem;">
                <div style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 0.5rem; margin-bottom: 1rem;">
                    <div style="font-size: 0.875rem; font-weight: 600;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                <h1 style="font-size: 1.5rem; font-weight: 700;">@yield('header')</h1>
                @yield('actions')
            </header>

            @if(session('success'))
                <div class="glass-card" style="margin-bottom: 1.5rem; background: rgba(16, 185, 129, 0.1); border-color: var(--success); color: var(--success);">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
