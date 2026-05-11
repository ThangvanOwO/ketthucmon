@extends('layouts.app')
@section('title', 'Giỏ hàng | KINETIC')

@section('content')
<div class="w-full max-w-[1440px] mx-auto px-6 md:px-8 py-16 md:py-24">
    <div class="mb-16">
        <h1 class="font-headline text-5xl md:text-6xl font-bold tracking-tighter text-on-background">Giỏ hàng của bạn</h1>
        <p class="font-body text-on-surface-variant mt-4 text-lg">Xem lại các sản phẩm trước khi thanh toán.</p>
    </div>

    @if(empty($cart) || count($cart) == 0)
    <div class="text-center py-24">
        <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">shopping_cart</span>
        <p class="font-headline text-2xl text-on-surface-variant mb-8">Giỏ hàng trống</p>
        <a href="{{ route('category.index') }}" class="bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold px-8 py-4 rounded-sm hover:opacity-90 transition-opacity inline-flex items-center gap-2">
            Tiếp tục mua sắm <span class="material-symbols-outlined">arrow_forward</span>
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-12 relative items-start">
        <div class="lg:col-span-8 flex flex-col gap-6">
            @php $total = 0; @endphp
            @foreach($cart as $id => $item)
            @php $total += $item['price'] * $item['quantity']; @endphp
            <div class="bg-surface-container-low rounded p-6 md:p-8 flex flex-col md:flex-row gap-8 relative group transition-colors duration-300 hover:bg-surface-container-high/50">
                <div class="w-full md:w-56 h-40 md:h-auto bg-surface-container-high rounded shrink-0 bg-cover bg-center" style="background-image: url('{{ $item['image'] ?: 'https://via.placeholder.com/300x200' }}');"></div>
                <div class="flex-grow flex flex-col justify-between py-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-headline text-2xl font-bold tracking-tight text-on-background mb-1">{{ $item['name'] }}</h3>
                            <p class="font-label text-sm text-on-surface-variant">Đơn giá: {{ number_format($item['price'], 0, ',', '.') }} VNĐ</p>
                        </div>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" aria-label="Xóa" class="text-outline hover:text-error transition-colors p-2 -mr-2 -mt-2">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </form>
                    </div>
                    <div class="flex justify-between items-end mt-8">
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-4 bg-surface-container-highest rounded-full px-4 py-2 border border-outline-variant/15">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 bg-transparent text-on-background text-center border-none focus:ring-0 font-body font-bold"/>
                            <button type="submit" class="text-primary font-label text-sm">Cập nhật</button>
                        </form>
                        <div class="font-headline text-2xl font-bold text-primary tracking-tight">
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <aside class="lg:col-span-4 sticky top-32">
            <div class="bg-surface-container-highest rounded p-8 flex flex-col shadow-[0_24px_48px_rgba(182,196,255,0.02)]">
                <h2 class="font-headline text-3xl font-bold tracking-tighter text-on-background mb-10">Tóm tắt</h2>
                <div class="space-y-6 font-body text-base">
                    <div class="flex justify-between items-center text-on-surface-variant">
                        <span>Tổng phụ ({{ count($cart) }} sản phẩm)</span>
                        <span class="text-on-background font-medium">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                    </div>
                </div>
                <div class="mt-10 p-6 bg-surface-container-low rounded flex flex-col gap-2">
                    <div class="flex justify-between items-end">
                        <span class="font-headline font-bold text-lg text-on-background">Tổng cộng</span>
                        <span class="font-headline text-3xl font-bold text-primary tracking-tight">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                    </div>
                </div>
                <a href="{{ route('checkout') }}" class="w-full bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold text-lg py-5 rounded mt-8 hover:opacity-90 transition-opacity flex items-center justify-center gap-2 group shadow-[0_8px_24px_rgba(41,98,255,0.15)]">
                    Tiến hành thanh toán
                    <span class="material-symbols-outlined text-lg transition-transform group-hover:translate-x-1">arrow_forward</span>
                </a>
                <div class="mt-6 flex items-center justify-center gap-2 text-on-surface-variant font-label text-xs uppercase tracking-widest">
                    <span class="material-symbols-outlined text-sm">lock</span>
                    Giao dịch được mã hóa an toàn
                </div>
            </div>
        </aside>
    </div>
    @endif
</div>
@endsection
