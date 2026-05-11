@extends('layouts.app')
@section('title', 'Tìm kiếm: ' . $query . ' | KINETIC')

@section('content')
<div class="w-full max-w-[1440px] mx-auto px-4 sm:px-8 py-12 flex flex-col gap-12">
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8">
        <div class="flex flex-col gap-2">
            <p class="text-on-surface-variant font-label text-sm uppercase tracking-widest">Kết quả tìm kiếm cho</p>
            <h1 class="font-headline text-4xl md:text-5xl font-bold tracking-tighter text-on-surface">"{{ $query }}"</h1>
            <p class="text-on-surface-variant mt-2 font-body">Tìm thấy {{ $products->total() }} kết quả.</p>
        </div>
    </header>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($products as $product)
        <article class="group bg-surface-container-low hover:bg-surface-container-high transition-all duration-300 rounded-md overflow-hidden flex flex-col cursor-pointer border border-transparent hover:border-outline-variant/15">
            <a href="{{ route('product.show', $product->slug) }}">
                <div class="relative aspect-[16/10] bg-surface-container-high overflow-hidden">
                    <img alt="{{ $product->name }}" class="w-full h-full object-cover opacity-90 group-hover:scale-105 group-hover:opacity-100 transition-all duration-500" src="{{ $product->image ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCJ27aOaGS8TDyJVxtnLjycnotkU0QRTI4rGHn3Za1UzNxR_o9L0urQWWJPoFfRfyK7yEEA74Kpm5fn52zEfx4wymGRQRyqo3v5uvlHU0o6IIaxqhPQXgo5VtMX4nxQXzm4hGNvmgHdRNrHJ68dNdWW0Ur0FzaXm_VmhnH63n6QrJweTx63QqWcgjCaDgifh0YW4pTPiEdTSLBVJfFkqMvp3QFUP_8Q0n70cS5xgkHxAeipf66NPB8XvD_BFhAoVF4C2luNaUALj0j' }}"/>
                    @if($product->quantity > 0)
                    <div class="absolute top-4 right-4 bg-background/80 backdrop-blur-md px-3 py-1 rounded-sm border border-outline-variant/20">
                        <span class="text-tertiary font-headline text-xs font-bold tracking-wider uppercase">Có sẵn</span>
                    </div>
                    @else
                    <div class="absolute top-4 right-4 bg-background/80 backdrop-blur-md px-3 py-1 rounded-sm border border-outline-variant/20">
                        <span class="text-error font-headline text-xs font-bold tracking-wider uppercase">Hết hàng</span>
                    </div>
                    @endif
                </div>
            </a>
            <div class="p-6 flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-on-surface-variant font-label text-xs uppercase tracking-widest mb-1">{{ $product->category->name ?? '' }}</p>
                        <h3 class="font-headline text-2xl font-bold text-on-surface group-hover:text-primary transition-colors">{{ $product->name }}</h3>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-auto pt-6 border-t border-outline-variant/10">
                    <p class="font-headline text-xl font-bold text-on-surface">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                    <a href="{{ route('product.show', $product->slug) }}" class="text-primary font-label text-sm group-hover:underline decoration-primary underline-offset-4 transition-all">Xem chi tiết</a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center py-16">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">search_off</span>
            <p class="font-headline text-2xl text-on-surface-variant">Không tìm thấy sản phẩm nào</p>
        </div>
        @endforelse
    </section>

    <div class="flex justify-center mt-8">
        {{ $products->appends(['q' => $query])->links() }}
    </div>
</div>
@endsection
