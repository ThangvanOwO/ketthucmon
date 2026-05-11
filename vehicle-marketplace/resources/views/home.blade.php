@extends('layouts.app')
@section('title', 'KINETIC - Trang chủ')

@section('content')
{{-- Hero Section --}}
<section class="relative w-full h-[100vh] min-h-[700px] bg-surface-container-lowest flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img alt="Sleek dark sports car" class="w-full h-full object-cover opacity-70 mix-blend-luminosity scale-105" style="animation:hero-zoom 20s ease-in-out infinite alternate" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0lCGL4tE5tSEQl0wO1xOjt0fFJVULnmLe8sNQo4_xYJwdUJXy6YLbWuD-Z5IwElCTJI7lxucFiMVWEsGX5YmDkr7dBgLtM-XVecQ5CUi7x0AOpKEQZSEUyo8YFFg_Obn3cXFGlOmcRRbSuE4aHI50ePvWIfBtqkxAlXtnUOT86jXUIK-Mno6DywJoz4Zrecg7z0wv_TXzlqceZOpY9NIJUHRa8jRB7R_DnA5tj6SluX7LwjH84EIr3qy4W-v8_uZo5pbdeXTy6oVU"/>
        <div class="absolute inset-0 bg-gradient-to-r from-background via-background/85 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-[1440px] mx-auto px-8 w-full">
        <div class="max-w-3xl">
            <p class="text-primary/60 font-label text-sm uppercase tracking-[0.4em] mb-6" style="animation:fadeInUp .8s ease .2s both">Precision Engineering</p>
            <h1 class="text-luxury text-6xl md:text-8xl lg:text-9xl text-on-background leading-[0.9] mb-8 text-glow" style="animation:fadeInUp .8s ease .4s both">
                Thiết kế cho <span class="text-gradient">sự hoàn hảo.</span>
            </h1>
            <p class="font-body text-on-surface-variant text-lg md:text-xl mb-12 max-w-lg leading-relaxed" style="animation:fadeInUp .8s ease .6s both">
                Khám phá đỉnh cao kỹ thuật ô tô. Những kiệt tác được tuyển chọn dành cho những ai đòi hỏi hiệu suất tuyệt đối.
            </p>
            <div class="flex items-center gap-6" style="animation:fadeInUp .8s ease .8s both">
                <a href="{{ route('category.index') }}" class="bg-gradient-to-r from-primary-container to-primary/80 text-white font-headline font-bold px-10 py-4 rounded-lg hover:shadow-[0_0_40px_rgba(182,196,255,0.3)] transition-all duration-300 flex items-center gap-3 group">
                    Khám phá bộ sưu tập
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
                <a href="{{ route('about') }}" class="text-on-surface-variant hover:text-primary font-headline font-medium transition-colors flex items-center gap-2 group">
                    <span class="w-12 h-[1px] bg-on-surface-variant/30 group-hover:bg-primary group-hover:w-16 transition-all"></span>
                    Tìm hiểu thêm
                </a>
            </div>
        </div>
    </div>
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10" style="animation:bounce-soft 2s infinite">
        <span class="material-symbols-outlined text-on-surface-variant/40 text-3xl">expand_more</span>
    </div>
</section>
@push('styles')
<style>
    @keyframes hero-zoom{0%{transform:scale(1)}100%{transform:scale(1.08)}}
    @keyframes fadeInUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
    @keyframes bounce-soft{0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(10px)}}
</style>
@endpush

{{-- Glow Divider --}}
<div class="glow-line"></div>

{{-- Categories Bento Grid --}}
<section class="max-w-[1440px] mx-auto px-8 py-24 bg-surface">
    <div class="flex justify-between items-end mb-12 reveal">
        <div>
            <p class="text-primary/50 font-label text-xs uppercase tracking-[0.3em] mb-3">Collection</p>
            <h2 class="text-luxury text-4xl md:text-6xl text-on-background tracking-tight">Danh mục</h2>
            <p class="font-body text-on-surface-variant mt-3 text-sm">Chọn loại xe phù hợp với phong cách của bạn</p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[600px] reveal stagger-2">
        @foreach($categories as $index => $cat)
            @if($index == 0)
            <a href="{{ route('category.show', $cat->id) }}" class="md:col-span-2 relative group overflow-hidden bg-surface-container-high rounded-DEFAULT flex items-end p-8 transition-colors duration-300 hover:bg-surface-container-highest">
                <img alt="{{ $cat->name }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 transition-opacity duration-500 mix-blend-luminosity" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCjbUMPjGCJUqCgbQ8uzPGpEVPZR7gJTnfymaqs7M7gqURQ3Wxf0FDa6Qst2jcqwFE_jRg2zXFTEg4cyf1Hjupc5sLTUhM0qSzHfhfJceM6zcd_f4x73FDzAYCDr0nPe0Tm906sMGANj8YHQPaTEbbKTEOzrORLwPxfdoFy5Q4r0iFhPoG_PYpXMxYxHtGV_9Yr0zgTAQj-U8gf-MOuknKOcFQOQdwYODiKi-uNNYv0msZq9ymD6CQrjHvgIcapNlyfmK65MHySwQZw"/>
                <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
                <div class="relative z-10 w-full flex justify-between items-end">
                    <div>
                        <h3 class="font-headline text-4xl font-bold text-on-background tracking-tight">{{ $cat->name }}</h3>
                        <p class="font-body text-primary mt-2 flex items-center gap-2 font-medium">
                            Xem kho hàng <span class="material-symbols-outlined text-sm">arrow_right_alt</span>
                        </p>
                    </div>
                </div>
            </a>
            @else
            <div class="flex flex-col gap-6 {{ $index == 1 ? '' : 'hidden' }}">
            @endif

            @if($index >= 1 && $index <= 2)
                <a href="{{ route('category.show', $cat->id) }}" class="flex-1 relative group overflow-hidden bg-surface-container-high rounded-DEFAULT flex items-end p-6 transition-colors duration-300 hover:bg-surface-container-highest">
                    <img alt="{{ $cat->name }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 transition-opacity duration-500 mix-blend-luminosity" src="{{ $index == 1 ? 'https://lh3.googleusercontent.com/aida-public/AB6AXuAdiIEs5ia_6j-v5x5Ay2trBtiye34RkvvLQpSGfDqGyF7wz43dbiUpcRO8UyKHaFlKJUCU-nuTZyHPKX1ms0SKeB88NJbPTgNasr5woa6h_qGoFqnObfw24G2cs6up7NHtuQLUBB_oCeFdqNKCQlDNkRXqDUaU8jdAeRKZs1q_fFayV4C3iUXobay881j0DX3dRQbuBRMHItmDHV2q85hj-wDBXqSSgnSYCsl03cwKqhN8Q6SY9VN1wHUAtlXB93R9onHYihzUySsn' : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBzYr4pFn8yB6ZoNY9tNMiM4VcV6MtX0kS4dpUg5YC3K_JDIQg_Q6PiXFJE9Vfc-7sNNv-O14kqEi-D3DMBFag4yD8zUHZ4lyW3d-a-kGQIJoWh7b3_eIkrg6E6Ejna01MWpfY7e-KW5DdCfVETBB30mVdY6tGQQH24rnerIdrtZCBspR2UeIMRLW0LG5nq_fznwMLqwjkAo7hDtIK1x3XerPi23OLeHPmRXIIPkmg1g2YkATpNJ-eRB1G4hlPWCu538xxrQCKfrp2O' }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
                    <div class="relative z-10">
                        <h3 class="font-headline text-2xl font-bold text-on-background tracking-tight {{ $index == 2 ? 'text-tertiary flex items-center gap-2' : '' }}">
                            @if($index == 2)<span class="material-symbols-outlined">bolt</span>@endif {{ $cat->name }}
                        </h3>
                        <p class="font-body text-primary mt-1 text-sm font-medium">Khám phá ngay</p>
                    </div>
                </a>
            @endif

            @if($index == 2)
            </div>
            @endif
        @endforeach
    </div>
</section>

{{-- Glow Divider --}}
<div class="glow-line"></div>

{{-- New Arrivals --}}
<section class="max-w-[1440px] mx-auto px-8 py-28 bg-surface-container-low">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6 reveal">
        <div>
            <p class="text-primary/50 font-label text-xs uppercase tracking-[0.3em] mb-3">New Arrivals</p>
            <h2 class="text-luxury text-4xl md:text-6xl text-on-background tracking-tight">Sản phẩm mới</h2>
            <p class="font-body text-on-surface-variant mt-3 max-w-xl">Trực tiếp từ nhà máy, được thiết kế hoàn hảo.</p>
        </div>
        <a href="{{ route('category.index') }}" class="border border-outline-variant/20 text-primary font-headline px-8 py-3 rounded-lg hover:bg-primary/5 hover:border-primary/30 transition-all text-sm uppercase tracking-wider">
            Xem tất cả
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($latestProducts as $index => $product)
        <div class="card-3d reveal stagger-{{ ($index % 4) + 1 }}">
            <a href="{{ route('product.show', $product->slug) }}" class="card-3d-inner group cursor-pointer block bg-surface-container rounded-xl overflow-hidden border border-outline-variant/5 hover:border-outline-variant/15 relative">
                <div class="card-3d-shine"></div>
                <div class="aspect-[16/10] overflow-hidden relative bg-surface-container-high">
                    <img alt="{{ $product->name }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-all duration-700 group-hover:scale-110" src="{{ $product->image ?: '' }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="p-5">
                    <p class="font-label text-xs text-tertiary uppercase tracking-[0.2em] mb-2 font-bold">{{ $product->category->name ?? '' }}</p>
                    <h3 class="font-headline text-lg font-bold text-on-background mb-2 group-hover:text-primary transition-colors">{{ $product->name }}</h3>
                    <div class="flex items-center justify-between">
                        <p class="text-gradient font-headline font-bold text-lg">{{ number_format($product->price, 0, ',', '.') }} <span class="text-xs">VNĐ</span></p>
                        <span class="material-symbols-outlined text-on-surface-variant/40 group-hover:text-primary group-hover:translate-x-1 transition-all text-lg">arrow_forward</span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- Glow Divider --}}
<div class="glow-line"></div>

{{-- Editorial Section --}}
<section class="max-w-[1440px] mx-auto px-8 py-32 bg-surface relative overflow-hidden">
    <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-primary/3 rounded-full blur-[150px] -translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center relative z-10">
        <div class="order-2 md:order-1 reveal-left">
            <div class="bg-surface-container-lowest/80 backdrop-blur-sm p-10 rounded-xl relative z-10 border border-outline-variant/10 shadow-[0_48px_100px_rgba(182,196,255,0.03)]">
                <p class="text-primary/50 font-label text-xs uppercase tracking-[0.3em] mb-4">Our Philosophy</p>
                <h3 class="text-luxury text-3xl md:text-4xl text-on-background mb-6 leading-tight">Được thiết kế cho <span class="text-gradient">người đam mê.</span></h3>
                <p class="font-body text-on-surface-variant leading-relaxed mb-10">
                    Chúng tôi không chỉ bán xe; chúng tôi mang đến trải nghiệm. Mỗi chiếc xe trong bộ sưu tập đều trải qua quy trình kiểm tra nghiêm ngặt.
                </p>
                <div class="space-y-8">
                    <div class="flex items-start gap-5 group">
                        <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 group-hover:bg-primary/20 transition-colors">
                            <span class="material-symbols-outlined text-primary text-2xl">precision_manufacturing</span>
                        </div>
                        <div>
                            <h4 class="font-headline font-bold text-on-background text-lg">Vật liệu cao cấp</h4>
                            <p class="font-body text-sm text-on-surface-variant mt-1">Được lấy từ các nhà cung cấp hàng không hiện đại.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5 group">
                        <div class="w-12 h-12 rounded-lg bg-tertiary/10 flex items-center justify-center flex-shrink-0 group-hover:bg-tertiary/20 transition-colors">
                            <span class="material-symbols-outlined text-tertiary text-2xl">speed</span>
                        </div>
                        <div>
                            <h4 class="font-headline font-bold text-on-background text-lg">Hiệu suất vượt trội</h4>
                            <p class="font-body text-sm text-on-surface-variant mt-1">Hệ thống treo và đo từ xa được hiệu chỉnh trên đường đua.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5 group">
                        <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 group-hover:bg-primary/20 transition-colors">
                            <span class="material-symbols-outlined text-primary text-2xl">shield</span>
                        </div>
                        <div>
                            <h4 class="font-headline font-bold text-on-background text-lg">An toàn tuyệt đối</h4>
                            <p class="font-body text-sm text-on-surface-variant mt-1">Tiêu chuẩn an toàn 5 sao EURO NCAP.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="order-1 md:order-2 reveal-right">
            <div class="relative">
                <img alt="Car engine detail" class="w-full h-auto object-cover rounded-xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWPqovcm3Lb960kZofwum3zcpQgGUbiz3drvOdS61cIXqHFp3AoQZkkyEvVge9vKzjjx3Pgmv6DZZPgIXpYe9k7Wy2E7-SbriRnUZhe91r9Yj91OPGBnkVSY9Y_mBd978DHn8xo5eKMAD-sjXrQV43NDIrTyx17BTW9bd8E2NPK9AZ71J1vALR9PjYXMpN4_4-jZ2WPN_hIx1LtmklpWgIea9QW5V7AgWg2JHqfePFWwLc3vHeEOFWGz2H0yvyGx01mewoqa_K9u1w"/>
                <div class="absolute -bottom-4 -right-4 w-32 h-32 border border-primary/20 rounded-xl"></div>
                <div class="absolute -top-4 -left-4 w-24 h-24 border border-tertiary/20 rounded-xl"></div>
            </div>
        </div>
    </div>
</section>

{{-- Stats Section --}}
<section class="bg-surface-container-lowest py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/3 via-transparent to-tertiary/3 pointer-events-none"></div>
    <div class="max-w-[1440px] mx-auto px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="reveal stagger-1">
                <p class="text-luxury text-4xl md:text-5xl text-gradient mb-2">500+</p>
                <p class="font-label text-xs uppercase tracking-[0.2em] text-on-surface-variant">Xe đã bán</p>
            </div>
            <div class="reveal stagger-2">
                <p class="text-luxury text-4xl md:text-5xl text-gradient mb-2">50+</p>
                <p class="font-label text-xs uppercase tracking-[0.2em] text-on-surface-variant">Thương hiệu</p>
            </div>
            <div class="reveal stagger-3">
                <p class="text-luxury text-4xl md:text-5xl text-gradient mb-2">99%</p>
                <p class="font-label text-xs uppercase tracking-[0.2em] text-on-surface-variant">Hài lòng</p>
            </div>
            <div class="reveal stagger-4">
                <p class="text-luxury text-4xl md:text-5xl text-gradient mb-2">24/7</p>
                <p class="font-label text-xs uppercase tracking-[0.2em] text-on-surface-variant">Hỗ trợ</p>
            </div>
        </div>
    </div>
</section>
@endsection
