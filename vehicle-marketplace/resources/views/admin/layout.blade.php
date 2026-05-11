<!DOCTYPE html>
<html class="dark" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'KINETIC Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Space+Grotesk:wght@400;500;600;700&amp;family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "bg-dark": "#0f1115",
                        "bg-card": "#1a1d23",
                        "bg-card-hover": "#22262e",
                        "border-color": "#2a2e38",
                        "text-primary": "#b6c4ff",
                        "text-muted": "#8b8fa3",
                        "accent": "#2962ff",
                        "accent-light": "#5c85ff",
                        "success": "#22c55e",
                        "warning": "#eab308",
                        "danger": "#ef4444",
                    },
                    fontFamily: {
                        sans: ["Manrope", "sans-serif"],
                        heading: ["Space Grotesk", "sans-serif"],
                        luxury: ["Playfair Display", "serif"],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { background: #0f1115; color: #e2e2e5; }
        .sidebar-link { transition: all 0.2s; border-radius: 0.5rem; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(41,98,255,0.1); color: #b6c4ff; }
        .sidebar-link.active { border-left: 3px solid #2962ff; }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex">

{{-- Sidebar --}}
<aside class="w-64 bg-bg-card border-r border-border-color flex flex-col fixed h-full z-40">
    <div class="p-6 border-b border-border-color">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-text-primary font-luxury italic tracking-tight">KINETIC</a>
        <p class="text-xs text-text-muted mt-1 uppercase tracking-widest">Admin Panel</p>
    </div>
    <nav class="flex-1 p-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-text-muted' }}">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm {{ request()->routeIs('admin.products.*') ? 'active' : 'text-text-muted' }}">
            <span class="material-symbols-outlined text-xl">inventory_2</span>
            Sản phẩm
        </a>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm {{ request()->routeIs('admin.orders.*') ? 'active' : 'text-text-muted' }}">
            <span class="material-symbols-outlined text-xl">receipt_long</span>
            Đơn hàng
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm {{ request()->routeIs('admin.categories.*') ? 'active' : 'text-text-muted' }}">
            <span class="material-symbols-outlined text-xl">category</span>
            Danh mục
        </a>
    </nav>
    <div class="p-4 border-t border-border-color">
        <a href="{{ route('home') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm text-text-muted">
            <span class="material-symbols-outlined text-xl">storefront</span>
            Về trang chủ
        </a>
        <div class="flex items-center gap-3 px-4 py-3 text-sm text-text-muted">
            <span class="material-symbols-outlined text-xl">account_circle</span>
            <span class="truncate">{{ Auth::user()->email }}</span>
        </div>
    </div>
</aside>

{{-- Main Content --}}
<div class="flex-1 ml-64">
    {{-- Top Bar --}}
    <header class="h-16 bg-bg-card/80 backdrop-blur-xl border-b border-border-color flex items-center justify-between px-8 sticky top-0 z-30">
        <h1 class="font-heading font-bold text-lg text-white">@yield('page-title', 'Dashboard')</h1>
        <div class="flex items-center gap-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-text-muted hover:text-danger text-sm flex items-center gap-1 transition-colors">
                    <span class="material-symbols-outlined text-lg">logout</span>
                    Đăng xuất
                </button>
            </form>
        </div>
    </header>

    {{-- Flash Messages --}}
    <div class="px-8 pt-6">
        @if(session('success'))
            <div class="bg-success/10 border border-success/20 text-success px-4 py-3 rounded-lg text-sm mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-danger/10 border border-danger/20 text-danger px-4 py-3 rounded-lg text-sm mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">error</span>
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Page Content --}}
    <main class="p-8">
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
