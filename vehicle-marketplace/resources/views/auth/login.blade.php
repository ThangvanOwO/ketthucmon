@extends('layouts.app')
@section('title', 'Đăng nhập | KINETIC')

@section('content')
<div class="flex-grow flex items-center justify-center relative w-full h-full min-h-[calc(100vh-160px)]">
    <div class="absolute inset-0 w-full h-full bg-surface-container-lowest z-0 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-background via-background/80 to-transparent z-10 w-full md:w-2/3"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent z-10 h-full"></div>
        <img alt="" class="object-cover w-full h-full opacity-40 mix-blend-luminosity" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkqFvxOEbFQ6oVy9mLsAQ_66o923DjIoAmSidH4fXHV8NENd5e5wY_YBTslpcWMUMTAdmeCfH4IoxR8rgGsHmD8wj3CVTbYoEX5QEl5kWcfOMSdFw1qD8fzFHsp9mtirKxUyV95xjdcj0jC-wNkabinQnKgq_fqIf6-_Gn-PncSd5QS_12a2yVOg--D4oYuFnfiFOiVSe4Uny0Up6PuEYh0OlWsfnF30qU6bwthBm_NCfgW0Yw0U5zfu8MeSd9W4dnpXWF55fwMkDw"/>
    </div>

    <div class="relative z-20 w-full max-w-md px-6 py-12 md:px-10 md:py-16 bg-surface-variant/60 backdrop-blur-2xl rounded-lg mx-4 border border-outline-variant/15 shadow-[0_48px_100px_-20px_rgba(182,196,255,0.08)]">
        <div class="mb-10 text-left">
            <h1 class="font-headline text-4xl font-bold tracking-tight text-on-background mb-2">Đăng nhập</h1>
            <p class="font-body text-base text-on-surface-variant">Xác thực để truy cập tài khoản của bạn.</p>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 bg-error-container/20 text-error rounded-sm font-body text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-2">
                <label class="block font-label text-sm font-medium text-on-surface-variant" for="email">Địa chỉ Email</label>
                <input class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-sm px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors font-body placeholder-outline/50" id="email" name="email" placeholder="email@example.com" required type="email" value="{{ old('email') }}"/>
            </div>
            <div class="space-y-2">
                <label class="block font-label text-sm font-medium text-on-surface-variant" for="password">Mật khẩu</label>
                <input class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-sm px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors font-body placeholder-outline/50" id="password" name="password" placeholder="••••••••" required type="password"/>
            </div>
            <div class="flex items-center mt-4">
                <input class="w-4 h-4 rounded-sm bg-surface-container-highest border-outline-variant text-primary focus:ring-primary focus:ring-offset-background" id="remember" name="remember" type="checkbox"/>
                <label class="ml-2 font-label text-sm text-on-surface-variant cursor-pointer" for="remember">Ghi nhớ đăng nhập</label>
            </div>
            <div class="pt-4 space-y-4">
                <button class="w-full bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold text-sm tracking-wide py-3.5 px-6 rounded-sm shadow-[0_0_20px_rgba(182,196,255,0.15)] hover:shadow-[0_0_30px_rgba(182,196,255,0.25)] transition-all duration-300 flex justify-center items-center gap-2" type="submit">
                    <span>ĐĂNG NHẬP</span>
                    <span class="material-symbols-outlined text-lg">login</span>
                </button>
                <div class="text-center pt-2">
                    <span class="font-body text-sm text-on-surface-variant">Chưa có tài khoản? </span>
                    <a class="font-body text-sm text-tertiary border-b border-transparent hover:border-tertiary transition-colors" href="{{ route('register') }}">Đăng ký ngay</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
