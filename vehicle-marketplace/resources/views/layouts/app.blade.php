<!DOCTYPE html>
<html class="dark" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'KINETIC - Automotive E-commerce')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Space+Grotesk:wght@400;500;600;700&amp;family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "background": "#121416",
                        "primary-container": "#2962ff",
                        "on-background": "#e2e2e5",
                        "on-primary-fixed-variant": "#003ab3",
                        "inverse-primary": "#004ee8",
                        "outline": "#8d90a2",
                        "on-tertiary-fixed": "#001f24",
                        "inverse-surface": "#e2e2e5",
                        "on-primary-fixed": "#001550",
                        "secondary": "#c1c6d7",
                        "primary": "#b6c4ff",
                        "tertiary-fixed-dim": "#00daf3",
                        "tertiary": "#00daf3",
                        "surface-dim": "#121416",
                        "surface-tint": "#b6c4ff",
                        "surface": "#121416",
                        "on-tertiary": "#00363d",
                        "outline-variant": "#434656",
                        "on-tertiary-container": "#e6fbff",
                        "on-tertiary-fixed-variant": "#004f58",
                        "on-secondary-container": "#b3b8c8",
                        "secondary-fixed-dim": "#c1c6d7",
                        "on-error": "#690005",
                        "surface-container-lowest": "#0c0e10",
                        "primary-fixed": "#dce1ff",
                        "error-container": "#93000a",
                        "surface-container-highest": "#333537",
                        "surface-container-low": "#1a1c1e",
                        "on-surface-variant": "#c3c5d8",
                        "tertiary-container": "#007d8c",
                        "primary-fixed-dim": "#b6c4ff",
                        "on-primary": "#002780",
                        "secondary-container": "#444956",
                        "on-error-container": "#ffdad6",
                        "on-secondary-fixed-variant": "#414754",
                        "on-secondary": "#2b303d",
                        "tertiary-fixed": "#9cf0ff",
                        "surface-bright": "#38393c",
                        "surface-container": "#1e2022",
                        "error": "#ffb4ab",
                        "surface-container-high": "#282a2c",
                        "secondary-fixed": "#dde2f3",
                        "on-primary-container": "#f7f5ff",
                        "surface-variant": "#333537",
                        "on-secondary-fixed": "#161c27",
                        "inverse-on-surface": "#2f3133",
                        "on-surface": "#e2e2e5"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Space Grotesk", "sans-serif"],
                        "body": ["Manrope", "sans-serif"],
                        "label": ["Manrope", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined[data-weight="fill"] {
            font-variation-settings: 'FILL' 1;
        }

        /* PRELOADER */
        #preloader{position:fixed;inset:0;z-index:9999;background:#121416;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:2rem;transition:opacity .6s ease,visibility .6s ease}
        #preloader.loaded{opacity:0;visibility:hidden;pointer-events:none}
        .loader-logo{font-family:'Playfair Display',serif;font-size:3.5rem;font-weight:900;font-style:italic;letter-spacing:-.05em;background:linear-gradient(135deg,#b6c4ff 0%,#00daf3 50%,#b6c4ff 100%);background-size:200% 200%;color:transparent;background-clip:text;animation:shimmer 2s ease infinite,pulse-glow 1.5s ease-in-out infinite}
        .loader-bar{width:120px;height:2px;background:rgba(182,196,255,.1);border-radius:2px;overflow:hidden}
        .loader-bar::after{content:'';display:block;height:100%;background:linear-gradient(90deg,transparent,#b6c4ff,#00daf3,transparent);animation:loader-slide 1.2s ease-in-out infinite}
        @keyframes shimmer{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
        @keyframes pulse-glow{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.7;transform:scale(1.05)}}
        @keyframes loader-slide{0%{transform:translateX(-100%)}100%{transform:translateX(100%)}}

        /* SCROLL REVEAL */
        .reveal{opacity:0;transform:translateY(60px);transition:opacity .8s cubic-bezier(.16,1,.3,1),transform .8s cubic-bezier(.16,1,.3,1)}
        .reveal.visible{opacity:1;transform:translateY(0)}
        .reveal-left{opacity:0;transform:translateX(-80px);transition:opacity .8s cubic-bezier(.16,1,.3,1),transform .8s cubic-bezier(.16,1,.3,1)}
        .reveal-left.visible{opacity:1;transform:translateX(0)}
        .reveal-right{opacity:0;transform:translateX(80px);transition:opacity .8s cubic-bezier(.16,1,.3,1),transform .8s cubic-bezier(.16,1,.3,1)}
        .reveal-right.visible{opacity:1;transform:translateX(0)}
        .reveal-scale{opacity:0;transform:scale(.85);transition:opacity .8s cubic-bezier(.16,1,.3,1),transform .8s cubic-bezier(.16,1,.3,1)}
        .reveal-scale.visible{opacity:1;transform:scale(1)}
        .stagger-1{transition-delay:.1s}.stagger-2{transition-delay:.2s}.stagger-3{transition-delay:.3s}
        .stagger-4{transition-delay:.4s}.stagger-5{transition-delay:.5s}.stagger-6{transition-delay:.6s}

        /* 3D CARD TILT */
        .card-3d{perspective:1200px}
        .card-3d-inner{transition:transform .35s cubic-bezier(.03,.98,.52,.99),box-shadow .35s ease;transform-style:preserve-3d;will-change:transform}
        .card-3d-inner:hover{box-shadow:0 35px 60px rgba(0,0,0,.5),0 0 40px rgba(182,196,255,.06)}
        .card-3d-shine{position:absolute;inset:0;z-index:2;pointer-events:none;background:radial-gradient(circle at var(--mx,50%) var(--my,50%),rgba(182,196,255,.1) 0%,transparent 60%);opacity:0;transition:opacity .3s;border-radius:inherit}
        .card-3d-inner:hover .card-3d-shine{opacity:1}

        /* LUXURY TEXT */
        .text-luxury{font-family:'Playfair Display',serif;font-weight:900;font-style:italic}
        .text-gradient{background:linear-gradient(135deg,#b6c4ff 0%,#00daf3 100%);color:transparent;background-clip:text}
        .text-glow{text-shadow:0 0 40px rgba(182,196,255,.3),0 0 80px rgba(182,196,255,.1)}

        /* GLOW LINE */
        .glow-line{height:1px;background:linear-gradient(90deg,transparent,#b6c4ff,#00daf3,transparent);opacity:.3}

        /* SMOOTH PAGE */
        html{scroll-behavior:smooth}
        main{animation:page-in .6s ease-out}
        @keyframes page-in{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
    </style>
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/sparkle.css') }}">
</head>
<body class="bg-background text-on-background font-body min-h-screen flex flex-col antialiased">

{{-- PRELOADER --}}
<div id="preloader">
    <div class="loader-logo">KINETIC</div>
    <div class="loader-bar"></div>
</div>

{{-- TopNavBar --}}
<nav class="bg-zinc-950/60 backdrop-blur-2xl text-[#b6c4ff] font-['Space_Grotesk'] tracking-tight sticky top-0 w-full z-50 shadow-[0_20px_50px_rgba(182,196,255,0.05)]">
    <div class="flex justify-between items-center max-w-[1440px] mx-auto px-8 py-5">
        <a class="text-2xl font-bold tracking-tighter text-[#b6c4ff] hover:bg-zinc-800/50 transition-all duration-300 active:scale-95 ease-in-out px-3 py-1 rounded-DEFAULT" href="{{ route('home') }}" style="font-family:'Playfair Display',serif;font-style:italic">KINETIC</a>
        <div class="hidden md:flex gap-8 items-center">
            @foreach($categories ?? [] as $cat)
                <a class="text-zinc-400 font-medium hover:text-white hover:bg-zinc-800/50 transition-all duration-300 active:scale-95 ease-in-out px-2 py-1 rounded-DEFAULT" href="{{ route('category.show', $cat->id) }}">{{ $cat->name }}</a>
            @endforeach
            <a class="text-zinc-400 font-medium hover:text-white hover:bg-zinc-800/50 transition-all duration-300 active:scale-95 ease-in-out px-2 py-1 rounded-DEFAULT" href="{{ route('about') }}">Giới thiệu</a>
        </div>
        <div class="flex items-center gap-4">
            {{-- Search --}}
            <form action="{{ route('search') }}" method="GET" class="relative hidden sm:block">
                <input name="q" class="bg-surface-container-high border-none text-on-surface text-sm rounded-full pl-10 pr-4 py-2 w-48 focus:ring-1 focus:ring-primary focus:outline-none placeholder-on-surface-variant font-label transition-all" placeholder="Tìm kiếm..." type="text" value="{{ request('q') }}"/>
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
            </form>
            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="text-[#b6c4ff] hover:text-white hover:bg-zinc-800/50 transition-all duration-300 active:scale-95 ease-in-out p-2 rounded-full flex items-center justify-center relative">
                <span class="material-symbols-outlined text-2xl">shopping_cart</span>
                @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 bg-tertiary text-on-tertiary text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                @endif
            </a>
            {{-- Account --}}
            @auth
                <div class="flex items-center gap-2">
                    @role('admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-[#00daf3] hover:text-white hover:bg-zinc-800/50 transition-all duration-300 active:scale-95 ease-in-out p-2 rounded-full flex items-center justify-center" title="Admin Panel">
                        <span class="material-symbols-outlined text-2xl">admin_panel_settings</span>
                    </a>
                    @endrole
                    @can('place orders')
                    <a href="{{ route('order.index') }}" class="text-[#b6c4ff] hover:text-white hover:bg-zinc-800/50 transition-all duration-300 active:scale-95 ease-in-out p-2 rounded-full flex items-center justify-center" title="Đơn hàng của tôi">
                        <span class="material-symbols-outlined text-2xl">receipt_long</span>
                    </a>
                    @endcan
                    <span class="text-sm text-zinc-400">{{ Auth::user()->email }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-[#b6c4ff] hover:text-white hover:bg-zinc-800/50 transition-all duration-300 active:scale-95 ease-in-out p-2 rounded-full">
                            <span class="material-symbols-outlined text-2xl">logout</span>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('auth') }}" class="text-[#b6c4ff] hover:text-white hover:bg-zinc-800/50 transition-all duration-300 active:scale-95 ease-in-out p-2 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">account_circle</span>
                </a>
            @endauth
        </div>
    </div>
</nav>

<main class="flex-grow">
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-[1440px] mx-auto px-8 py-4">
            <div class="bg-tertiary-container/20 text-tertiary p-4 rounded-sm font-body">{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-[1440px] mx-auto px-8 py-4">
            <div class="bg-error-container/20 text-error p-4 rounded-sm font-body">{{ session('error') }}</div>
        </div>
    @endif

    @yield('content')
</main>

{{-- Footer --}}
<footer class="relative bg-surface-container-lowest text-on-surface-variant font-body w-full overflow-hidden">
    {{-- Glow divider --}}
    <div class="glow-line"></div>

    {{-- Newsletter CTA --}}
    <div class="max-w-[1440px] mx-auto px-8 pt-16 pb-12">
        <div class="relative bg-surface-container rounded-2xl p-8 md:p-12 border border-outline-variant/10 overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-tertiary/5 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div>
                    <p class="text-tertiary font-label text-xs uppercase tracking-[0.3em] mb-2 font-bold">Newsletter</p>
                    <h3 class="font-headline text-2xl md:text-3xl font-bold text-on-background tracking-tight">Nhận ưu đãi độc quyền</h3>
                    <p class="font-body text-on-surface-variant mt-2">Đăng ký để nhận thông tin về sản phẩm mới và chương trình khuyến mãi.</p>
                </div>
                <form class="flex gap-3 w-full md:w-auto" onsubmit="event.preventDefault(); this.querySelector('button').textContent='ĐÃ ĐĂNG KÝ ✓'; this.querySelector('button').disabled=true;">
                    <input type="email" placeholder="email@kinetic.com" required class="flex-grow md:w-80 bg-surface-container-highest border border-outline-variant/15 rounded-xl px-5 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all text-sm font-body"/>
                    <button type="submit" class="bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold px-8 py-3.5 rounded-xl hover:opacity-90 transition-all whitespace-nowrap text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">mail</span>
                        Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Main Footer Content --}}
    <div class="max-w-[1440px] mx-auto px-8 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 pb-12 border-b border-outline-variant/10">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="inline-block mb-6" style="font-family:'Playfair Display',serif;font-style:italic">
                    <span class="text-3xl font-black text-on-background">KINETIC</span>
                </a>
                <p class="font-body text-on-surface-variant text-sm leading-relaxed max-w-sm mb-6">
                    Hệ thống phân phối xe cao cấp hàng đầu. Trải nghiệm đỉnh cao kỹ thuật ô tô với thiết kế tinh xảo và hiệu suất vượt trội.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-primary/10 transition-all group" title="Facebook">
                        <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">public</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:text-tertiary hover:bg-tertiary/10 transition-all group" title="Instagram">
                        <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">photo_camera</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-primary/10 transition-all group" title="YouTube">
                        <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">play_circle</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-primary/10 transition-all group" title="Zalo">
                        <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">chat</span>
                    </a>
                </div>
            </div>

            {{-- Showroom --}}
            <div>
                <h4 class="font-headline text-sm font-bold text-on-background uppercase tracking-wider mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                    Phòng trưng bày
                </h4>
                <ul class="space-y-3">
                    @foreach($categories ?? [] as $cat)
                    <li>
                        <a class="text-sm text-on-surface-variant hover:text-primary transition-all flex items-center gap-2 group" href="{{ route('category.show', $cat->id) }}">
                            <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">arrow_forward</span>
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <a class="text-sm text-on-surface-variant hover:text-primary transition-all flex items-center gap-2 group" href="{{ route('about') }}">
                            <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">arrow_forward</span>
                            Giới thiệu
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="font-headline text-sm font-bold text-on-background uppercase tracking-wider mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-tertiary rounded-full"></span>
                    Hỗ trợ
                </h4>
                <ul class="space-y-3">
                    <li>
                        <a class="text-sm text-on-surface-variant hover:text-primary transition-all flex items-center gap-2 group" href="#">
                            <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">arrow_forward</span>
                            Chính sách bảo mật
                        </a>
                    </li>
                    <li>
                        <a class="text-sm text-on-surface-variant hover:text-primary transition-all flex items-center gap-2 group" href="#">
                            <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">arrow_forward</span>
                            Điều khoản dịch vụ
                        </a>
                    </li>
                    <li>
                        <a class="text-sm text-on-surface-variant hover:text-primary transition-all flex items-center gap-2 group" href="#">
                            <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">arrow_forward</span>
                            Chính sách đổi trả
                        </a>
                    </li>
                    <li>
                        <a class="text-sm text-on-surface-variant hover:text-primary transition-all flex items-center gap-2 group" href="#">
                            <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">arrow_forward</span>
                            Hướng dẫn mua hàng
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-headline text-sm font-bold text-on-background uppercase tracking-wider mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                    Liên hệ
                </h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-on-surface-variant text-lg mt-0.5">location_on</span>
                        <span class="text-sm text-on-surface-variant">123 Đường Lê Lợi, Quận 1, TP.HCM</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-on-surface-variant text-lg">phone</span>
                        <span class="text-sm text-on-surface-variant">1800 8001 (Miễn phí)</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-on-surface-variant text-lg">mail</span>
                        <span class="text-sm text-on-surface-variant">hello@kinetic.vn</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-on-surface-variant text-lg">schedule</span>
                        <span class="text-sm text-on-surface-variant">T2-T7: 8:00 - 18:00</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-8">
            <p class="text-xs text-on-surface-variant/60 font-label">
                © {{ date('Y') }} KINETIC GALLERY. Bảo lưu mọi quyền.
            </p>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-xs text-on-surface-variant/40">
                    <span class="material-symbols-outlined text-sm">shield</span>
                    <span>SSL 256-bit</span>
                </div>
                <div class="w-px h-4 bg-outline-variant/20"></div>
                <div class="flex items-center gap-2 text-xs text-on-surface-variant/40">
                    <span class="material-symbols-outlined text-sm">verified</span>
                    <span>PCI DSS</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
// Preloader
window.addEventListener('load', () => {
    setTimeout(() => document.getElementById('preloader')?.classList.add('loaded'), 400);
});

// Scroll Reveal
const revealEls = () => document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale');
const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }});
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
const initReveal = () => revealEls().forEach(el => io.observe(el));
document.addEventListener('DOMContentLoaded', initReveal);

// 3D Card Tilt
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.card-3d-inner').forEach(card => {
        card.addEventListener('mousemove', e => {
            const r = card.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width;
            const y = (e.clientY - r.top) / r.height;
            const tiltX = (y - 0.5) * -12;
            const tiltY = (x - 0.5) * 12;
            card.style.transform = `rotateX(${tiltX}deg) rotateY(${tiltY}deg) scale3d(1.02,1.02,1.02)`;
            card.style.setProperty('--mx', `${x * 100}%`);
            card.style.setProperty('--my', `${y * 100}%`);
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'rotateX(0) rotateY(0) scale3d(1,1,1)';
        });
    });
});
</script>
<script src="{{ asset('js/sparkle.js') }}"></script>
@stack('scripts')
</body>
</html>
