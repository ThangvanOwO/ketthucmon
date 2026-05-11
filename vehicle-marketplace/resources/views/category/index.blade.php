@extends('layouts.app')
@section('title', 'KINETIC - Kho hàng')

@section('content')
<div class="max-w-[1440px] w-full mx-auto px-4 md:px-8 py-8 flex flex-col gap-8">
    <header class="flex flex-col gap-4">
        <nav aria-label="Breadcrumb" class="text-sm font-label text-on-surface-variant flex items-center gap-2">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Trang chủ</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-medium">Tất cả sản phẩm</span>
        </nav>
        <h1 class="text-luxury text-4xl md:text-6xl text-on-background tracking-tight">Kho hàng</h1>
    </header>

    <div class="flex flex-col md:flex-row gap-12">
        {{-- Filters Sidebar --}}
        <aside class="w-full md:w-72 flex-shrink-0 flex flex-col gap-8">
            <div class="bg-surface-container-low p-6 rounded-lg flex flex-col gap-4">
                <h3 class="font-headline text-lg font-semibold text-primary">Loại xe</h3>
                <div class="flex flex-col gap-3 font-label text-sm text-on-surface">
                    @foreach($allCategories as $cat)
                    <a href="{{ route('category.show', $cat->id) }}" class="flex items-center gap-3 cursor-pointer group hover:text-primary transition-colors {{ isset($currentCategory) && $currentCategory->id == $cat->id ? 'text-primary font-bold' : '' }}">
                        <span>{{ $cat->name }}</span>
                        <span class="text-on-surface-variant text-xs">({{ $cat->products_count }})</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- Product Grid --}}
        <div class="flex-grow grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $index => $product)
            <div class="card-3d reveal stagger-{{ ($index % 3) + 1 }}">
            <article class="card-3d-inner group bg-surface-container-low rounded-xl overflow-hidden flex flex-col transition-all duration-300 relative border border-outline-variant/5 hover:border-outline-variant/15">
                <div class="card-3d-shine"></div>
                <a href="{{ route('product.show', $product->slug) }}">
                    <div class="aspect-[4/3] w-full bg-surface-container-high relative overflow-hidden">
                        <img alt="{{ $product->name }}" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-700 ease-in-out" src="{{ $product->image ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBmMBEClJZnf34hU7lGVhUkET6GZ-hDyxioTguYtE7QGg0V9F9qQwn7UbKySGLcoh-Ucd6g7nr-ZRQekl547djlGTVUet9d8AoDAx6P1zkwNRcw4xr5TwTUGulJUxBLlOZFcYPb5ub3Rv-xRR7_19LsdRj_YIYn5CKNHLJ7rti5kfLg3PM6rcCpZL2DRxSKxW8UFszaID7_KU8VBmK3d8gyeaAViqy3PmG5zczi2B_-4KSS2xex_CtVQagbMH9A3VBOehxaG4TWVkpY' }}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low via-transparent to-transparent opacity-60"></div>
                    </div>
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="font-headline text-xl font-semibold text-on-background mb-1 group-hover:text-primary transition-colors">{{ $product->name }}</h2>
                            <p class="font-label text-sm text-on-surface-variant">{{ $product->category->name ?? '' }}</p>
                        </div>
                        <p class="font-headline text-lg font-bold text-primary">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                    </div>
                    <div class="flex gap-4 mb-6 text-sm font-label text-on-surface-variant">
                        <div class="flex flex-col">
                            <span class="text-xs uppercase tracking-wider mb-1 opacity-60">Tồn kho</span>
                            <span class="font-semibold text-on-surface">{{ $product->quantity }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs uppercase tracking-wider mb-1 opacity-60">Lượt xem</span>
                            <span class="font-semibold text-on-surface">{{ $product->view }}</span>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('product.show', $product->slug) }}" class="w-full py-3 px-6 rounded-lg border border-outline-variant/15 text-primary font-headline font-semibold uppercase tracking-wider hover:bg-primary/5 hover:border-primary/30 transition-all flex items-center justify-center gap-2">
                            Xem chi tiết
                            <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </article>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">inventory_2</span>
                <p class="font-headline text-2xl text-on-surface-variant">Chưa có sản phẩm nào</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection
