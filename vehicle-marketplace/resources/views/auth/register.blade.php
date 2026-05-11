@extends('layouts.app')
@section('title', 'Đăng ký | KINETIC')

@section('content')
<div class="flex-grow flex items-center justify-center py-20 px-4 relative overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-primary-container/10 blur-[120px]"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-tertiary-container/10 blur-[120px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="hidden lg:flex flex-col h-full justify-between">
            <div>
                <h2 class="text-6xl font-headline font-bold text-on-background tracking-tighter leading-tight mb-6">
                    Tham gia <br/>cộng đồng <br/><span class="text-primary">KINETIC.</span>
                </h2>
                <p class="text-on-surface-variant font-body text-lg max-w-md">
                    Tham gia cộng đồng những người đam mê xe hiệu suất cao. Trải nghiệm đỉnh cao kỹ thuật ô tô.
                </p>
            </div>
            <div class="relative w-full aspect-[4/3] rounded-lg overflow-hidden mt-12 bg-surface-container-high">
                <img alt="Sports car" class="object-cover w-full h-full opacity-80 mix-blend-luminosity" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBV6JPUO94yyKeIPGPOigykfgtIMHzokmz_3xWDlt8dPng6K0i5LbIYVUmQtFkDvYSNg0CBQFP2iqpL45zEqVbrH6Shb7_WVOu4fXbIv2pyOWzsBtV_VvgYH4lfBWjk18CSrd69D2NZ7jKJiiWdDKaHtEA0gXIQ1EHjiie9z_JztK_dakvIy6ZgI0wtgcRMTlGHFSPXzxQNjw770iTPYwSh0JMbreL4nXvpC_8uvao80c6Wq9kAqaZ2yJSqVaC7bPAkdDAtRS85-hqK"/>
                <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
            </div>
        </div>

        <div class="bg-surface-container-low p-8 md:p-12 rounded-xl shadow-[0_48px_100px_-20px_rgba(182,196,255,0.08)] w-full max-w-md mx-auto lg:mx-0 relative border-l border-surface-container-highest/30">
            <div class="mb-10 text-center lg:text-left">
                <h3 class="text-3xl font-headline font-bold text-on-background mb-2">Tạo tài khoản</h3>
                <p class="text-on-surface-variant font-body text-sm">Nhập thông tin để đăng ký.</p>
            </div>

            @if($errors->any())
            <div class="mb-6 p-4 bg-error-container/20 text-error rounded-sm font-body text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="space-y-1">
                    <label class="text-on-surface-variant font-label text-sm uppercase tracking-wider block" for="email">Địa chỉ Email</label>
                    <input class="w-full bg-surface-container-highest text-on-background rounded-sm border border-transparent focus:border-primary/50 focus:ring-0 transition-colors py-3 px-4 font-body placeholder-on-surface-variant/50" id="email" name="email" placeholder="email@example.com" required type="email" value="{{ old('email') }}"/>
                </div>
                <div class="space-y-1">
                    <label class="text-on-surface-variant font-label text-sm uppercase tracking-wider block" for="password">Mật khẩu</label>
                    <input class="w-full bg-surface-container-highest text-on-background rounded-sm border border-transparent focus:border-primary/50 focus:ring-0 transition-colors py-3 px-4 font-body placeholder-on-surface-variant/50" id="password" name="password" placeholder="••••••••" required type="password"/>
                </div>
                <div class="space-y-1">
                    <label class="text-on-surface-variant font-label text-sm uppercase tracking-wider block" for="password_confirmation">Xác nhận mật khẩu</label>
                    <input class="w-full bg-surface-container-highest text-on-background rounded-sm border border-transparent focus:border-primary/50 focus:ring-0 transition-colors py-3 px-4 font-body placeholder-on-surface-variant/50" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required type="password"/>
                </div>
                <div class="pt-6">
                    <button class="w-full bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold tracking-wide rounded-sm py-4 px-6 hover:opacity-90 transition-opacity flex justify-center items-center gap-2" type="submit">
                        ĐĂNG KÝ TÀI KHOẢN
                        <span class="material-symbols-outlined text-xl">arrow_forward</span>
                    </button>
                </div>
            </form>
            <div class="mt-8 text-center">
                <p class="font-body text-sm text-on-surface-variant">
                    Đã có tài khoản?
                    <a class="text-primary font-medium hover:text-primary-fixed transition-colors border-b border-primary/30 pb-0.5 ml-1" href="{{ route('login') }}">Đăng nhập</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
