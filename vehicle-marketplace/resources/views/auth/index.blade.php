@extends('layouts.app')
@section('title', 'Đăng nhập & Đăng ký | KINETIC')

@section('content')
<div class="flex-grow flex items-center justify-center relative w-full min-h-[calc(100vh-80px)] overflow-hidden">
    {{-- Background Effects --}}
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-primary-container/8 blur-[150px]"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-tertiary-container/8 blur-[150px]"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full bg-primary/3 blur-[200px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-6xl mx-auto px-4 md:px-8 py-12 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        {{-- Left: Branding --}}
        <div class="hidden lg:flex flex-col h-full justify-between" id="branding-panel">
            <div>
                <p class="text-primary/50 font-label text-xs uppercase tracking-[0.4em] mb-6">Welcome to</p>
                <h2 class="text-6xl font-headline font-bold text-on-background tracking-tighter leading-[0.95] mb-8">
                    Thiết kế cho<br/>
                    <span class="text-gradient">sự hoàn hảo.</span>
                </h2>
                <p class="text-on-surface-variant font-body text-lg max-w-md leading-relaxed">
                    Tham gia cộng đồng những người đam mê xe hiệu suất cao. Trải nghiệm đỉnh cao kỹ thuật ô tô tại KINETIC.
                </p>
            </div>

            {{-- Stats --}}
            <div class="mt-16 grid grid-cols-3 gap-6">
                <div class="text-center">
                    <p class="text-luxury text-3xl text-gradient mb-1">500+</p>
                    <p class="font-label text-xs text-on-surface-variant uppercase tracking-wider">Xe đã bán</p>
                </div>
                <div class="text-center">
                    <p class="text-luxury text-3xl text-gradient mb-1">50+</p>
                    <p class="font-label text-xs text-on-surface-variant uppercase tracking-wider">Thương hiệu</p>
                </div>
                <div class="text-center">
                    <p class="text-luxury text-3xl text-gradient mb-1">99%</p>
                    <p class="font-label text-xs text-on-surface-variant uppercase tracking-wider">Hài lòng</p>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative w-full aspect-[16/9] rounded-xl overflow-hidden mt-12 bg-surface-container-high">
                <img alt="KINETIC Vehicle" class="object-cover w-full h-full opacity-70 mix-blend-luminosity" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBV6JPUO94yyKeIPGPOigykfgtIMHzokmz_3xWDlt8dPng6K0i5LbIYVUmQtFkDvYSNg0CBQFP2iqpL45zEqVbrH6Shb7_WVOu4fXbIv2pyOWzsBtV_VvgYH4lfBWjk18CSrd69D2NZ7jKJiiWdDKaHtEA0gXIQ1EHjiie9z_JztK_dakvIy6ZgI0wtgcRMTlGHFSPXzxQNjw770iTPYwSh0JMbreL4nXvpC_8uvao80c6Wq9kAqaZ2yJSqVaC7bPAkdDAtRS85-hqK"/>
                <div class="absolute inset-0 bg-gradient-to-t from-background via-background/30 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-background/40 to-transparent"></div>
            </div>
        </div>

        {{-- Right: Auth Forms --}}
        <div class="w-full max-w-lg mx-auto lg:mx-0">
            <div class="bg-surface-container-low/80 backdrop-blur-2xl rounded-2xl border border-outline-variant/10 shadow-[0_48px_100px_-20px_rgba(182,196,255,0.08)] overflow-hidden">
                {{-- Tab Navigation --}}
                <div class="relative flex border-b border-outline-variant/10">
                    <button id="tab-login" onclick="switchTab('login')" class="flex-1 py-5 font-headline text-sm font-bold tracking-wider uppercase text-center transition-all duration-300 relative z-10">
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">login</span>
                            Đăng nhập
                        </span>
                    </button>
                    <button id="tab-register" onclick="switchTab('register')" class="flex-1 py-5 font-headline text-sm font-bold tracking-wider uppercase text-center transition-all duration-300 relative z-10">
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">person_add</span>
                            Đăng ký
                        </span>
                    </button>
                    {{-- Sliding Indicator --}}
                    <div id="tab-indicator" class="absolute bottom-0 h-[3px] w-1/2 bg-gradient-to-r from-primary-container to-primary transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] rounded-full"></div>
                </div>

                {{-- Forms Container --}}
                <div class="relative overflow-hidden">
                    {{-- LOGIN FORM --}}
                    <div id="form-login" class="p-8 md:p-10 transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]">
                        <div class="mb-8">
                            <h2 class="font-headline text-2xl font-bold tracking-tight text-on-background mb-2">Chào mừng trở lại</h2>
                            <p class="font-body text-sm text-on-surface-variant">Đăng nhập để truy cập tài khoản của bạn.</p>
                        </div>

                        @if($errors->has('email') && request('tab') !== 'register')
                        <div class="mb-6 p-4 bg-error-container/20 text-error rounded-lg font-body text-sm flex items-start gap-3">
                            <span class="material-symbols-outlined text-lg mt-0.5">error</span>
                            <div>
                                @foreach($errors->get('email') as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <form class="space-y-5" method="POST" action="{{ route('login') }}" id="login-form">
                            @csrf
                            <div class="space-y-2">
                                <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider" for="login-email">Địa chỉ Email</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-xl">mail</span>
                                    <input class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-4 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300 font-body placeholder-outline/40 text-sm" id="login-email" name="email" placeholder="email@example.com" required type="email" value="{{ old('email') }}"/>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider" for="login-password">Mật khẩu</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-xl">lock</span>
                                    <input class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-12 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300 font-body placeholder-outline/40 text-sm" id="login-password" name="password" placeholder="••••••••" required type="password"/>
                                    <button type="button" onclick="togglePassword('login-password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 hover:text-on-surface-variant transition-colors">
                                        <span class="material-symbols-outlined text-xl">visibility_off</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-1">
                                <label class="flex items-center gap-2.5 cursor-pointer group">
                                    <input class="w-4 h-4 rounded-md bg-surface-container-highest border-outline-variant text-primary focus:ring-primary focus:ring-offset-background transition-colors" id="remember" name="remember" type="checkbox"/>
                                    <span class="font-label text-sm text-on-surface-variant group-hover:text-on-surface transition-colors">Ghi nhớ đăng nhập</span>
                                </label>
                            </div>
                            <div class="pt-2">
                                <button class="w-full bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold text-sm tracking-wider py-4 px-6 rounded-xl shadow-[0_0_30px_rgba(41,98,255,0.2)] hover:shadow-[0_0_40px_rgba(41,98,255,0.35)] transition-all duration-300 flex justify-center items-center gap-2.5 group" type="submit">
                                    <span>ĐĂNG NHẬP</span>
                                    <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </button>
                            </div>
                        </form>

                        {{-- Divider --}}
                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-outline-variant/10"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-surface-container-low px-4 text-xs font-label text-on-surface-variant/60 uppercase tracking-wider">hoặc</span>
                            </div>
                        </div>

                        {{-- Switch to Register --}}
                        <div class="text-center">
                            <p class="font-body text-sm text-on-surface-variant">
                                Chưa có tài khoản?
                                <button onclick="switchTab('register')" class="text-tertiary font-semibold hover:text-tertiary/80 transition-colors ml-1 border-b border-tertiary/30 hover:border-tertiary/60 pb-0.5">
                                    Đăng ký ngay
                                </button>
                            </p>
                        </div>
                    </div>

                    {{-- REGISTER FORM --}}
                    <div id="form-register" class="p-8 md:p-10 transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] absolute top-0 left-0 right-0 opacity-0 pointer-events-none translate-x-8">
                        <div class="mb-8">
                            <h2 class="font-headline text-2xl font-bold tracking-tight text-on-background mb-2">Tạo tài khoản mới</h2>
                            <p class="font-body text-sm text-on-surface-variant">Tham gia cộng đồng KINETIC ngay hôm nay.</p>
                        </div>

                        @if($errors->any() && request('tab') === 'register')
                        <div class="mb-6 p-4 bg-error-container/20 text-error rounded-lg font-body text-sm flex items-start gap-3">
                            <span class="material-symbols-outlined text-lg mt-0.5">error</span>
                            <div>
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <form class="space-y-5" method="POST" action="{{ route('register') }}" id="register-form">
                            @csrf
                            <div class="space-y-2">
                                <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider" for="reg-email">Địa chỉ Email</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-xl">mail</span>
                                    <input class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-4 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300 font-body placeholder-outline/40 text-sm" id="reg-email" name="email" placeholder="email@example.com" required type="email" value="{{ old('email') }}"/>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider" for="reg-password">Mật khẩu</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-xl">lock</span>
                                    <input class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-12 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300 font-body placeholder-outline/40 text-sm" id="reg-password" name="password" placeholder="Tối thiểu 6 ký tự" required type="password" minlength="6"/>
                                    <button type="button" onclick="togglePassword('reg-password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 hover:text-on-surface-variant transition-colors">
                                        <span class="material-symbols-outlined text-xl">visibility_off</span>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider" for="reg-password-confirm">Xác nhận mật khẩu</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-xl">lock</span>
                                    <input class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-12 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-300 font-body placeholder-outline/40 text-sm" id="reg-password-confirm" name="password_confirmation" placeholder="Nhập lại mật khẩu" required type="password"/>
                                    <button type="button" onclick="togglePassword('reg-password-confirm', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 hover:text-on-surface-variant transition-colors">
                                        <span class="material-symbols-outlined text-xl">visibility_off</span>
                                    </button>
                                </div>
                            </div>
                            <div class="pt-2">
                                <button class="w-full bg-gradient-to-r from-tertiary-container to-tertiary text-on-tertiary font-headline font-bold text-sm tracking-wider py-4 px-6 rounded-xl shadow-[0_0_30px_rgba(0,218,243,0.15)] hover:shadow-[0_0_40px_rgba(0,218,243,0.3)] transition-all duration-300 flex justify-center items-center gap-2.5 group" type="submit">
                                    <span>TÀI KHOẢN MỚI</span>
                                    <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </button>
                            </div>
                        </form>

                        {{-- Divider --}}
                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-outline-variant/10"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-surface-container-low px-4 text-xs font-label text-on-surface-variant/60 uppercase tracking-wider">hoặc</span>
                            </div>
                        </div>

                        {{-- Switch to Login --}}
                        <div class="text-center">
                            <p class="font-body text-sm text-on-surface-variant">
                                Đã có tài khoản?
                                <button onclick="switchTab('login')" class="text-primary font-semibold hover:text-primary/80 transition-colors ml-1 border-b border-primary/30 hover:border-primary/60 pb-0.5">
                                    Đăng nhập
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Security Badge --}}
            <div class="flex items-center justify-center gap-2 mt-6 text-on-surface-variant/40">
                <span class="material-symbols-outlined text-sm">shield</span>
                <span class="font-label text-xs uppercase tracking-wider">Bảo mật SSL 256-bit</span>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Tab active states */
    #tab-login.active, #tab-register.active {
        color: var(--color-on-background, #e2e2e5);
    }
    #tab-login:not(.active), #tab-register:not(.active) {
        color: var(--color-on-surface-variant, #8b8fa3);
    }
    #tab-login:not(.active):hover, #tab-register:not(.active):hover {
        color: var(--color-on-surface, #c3c5d8);
    }

    /* Form transitions */
    .form-enter {
        opacity: 1 !important;
        transform: translateX(0) !important;
        pointer-events: auto !important;
    }
    .form-exit-left {
        opacity: 0 !important;
        transform: translateX(-32px) !important;
        pointer-events: none !important;
    }
    .form-exit-right {
        opacity: 0 !important;
        transform: translateX(32px) !important;
        pointer-events: none !important;
    }

    /* Smooth height transition */
    #form-login, #form-register {
        transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                    transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Input focus glow */
    input:focus {
        box-shadow: 0 0 0 3px rgba(182, 196, 255, 0.1);
    }

    /* Button press effect */
    button:active[type="submit"] {
        transform: scale(0.98);
    }
</style>
@endpush

@push('scripts')
<script>
    let currentTab = '{{ request("tab") === "register" ? "register" : "login" }}';

    function switchTab(tab) {
        if (tab === currentTab) return;

        const loginForm = document.getElementById('form-login');
        const registerForm = document.getElementById('form-register');
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');
        const indicator = document.getElementById('tab-indicator');

        if (tab === 'register') {
            // Slide login out to left, register in from right
            loginForm.classList.remove('form-enter');
            loginForm.classList.add('form-exit-left');

            setTimeout(() => {
                loginForm.style.position = 'absolute';
                loginForm.style.top = '0';
                loginForm.style.left = '0';
                loginForm.style.right = '0';

                registerForm.classList.remove('form-exit-right', 'absolute');
                registerForm.style.position = 'relative';
                registerForm.classList.add('form-enter');
            }, 150);

            indicator.style.transform = 'translateX(100%)';
            tabLogin.classList.remove('active');
            tabRegister.classList.add('active');
        } else {
            // Slide register out to right, login in from left
            registerForm.classList.remove('form-enter');
            registerForm.classList.add('form-exit-right');

            setTimeout(() => {
                registerForm.style.position = 'absolute';
                registerForm.style.top = '0';
                registerForm.style.left = '0';
                registerForm.style.right = '0';

                loginForm.classList.remove('form-exit-left', 'absolute');
                loginForm.style.position = 'relative';
                loginForm.classList.add('form-enter');
            }, 150);

            indicator.style.transform = 'translateX(0)';
            tabRegister.classList.remove('active');
            tabLogin.classList.add('active');
        }

        currentTab = tab;

        // Update URL without reload
        const url = new URL(window.location);
        url.searchParams.set('tab', tab);
        window.history.replaceState({}, '', url);
    }

    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('.material-symbols-outlined');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility_off';
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('form-login');
        const registerForm = document.getElementById('form-register');
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');
        const indicator = document.getElementById('tab-indicator');

        if (currentTab === 'register') {
            loginForm.style.position = 'absolute';
            loginForm.style.top = '0';
            loginForm.style.left = '0';
            loginForm.style.right = '0';
            loginForm.classList.add('form-exit-left');

            registerForm.classList.remove('absolute', 'opacity-0', 'pointer-events-none', 'translate-x-8');
            registerForm.style.position = 'relative';
            registerForm.classList.add('form-enter');

            indicator.style.transform = 'translateX(100%)';
            tabRegister.classList.add('active');
        } else {
            loginForm.classList.remove('opacity-0');
            loginForm.classList.add('form-enter');
            tabLogin.classList.add('active');
        }
    });
</script>
@endpush
@endsection
