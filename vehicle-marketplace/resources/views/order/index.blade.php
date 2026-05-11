@extends('layouts.app')
@section('title', 'KINETIC - Đơn hàng của tôi')

@section('content')
<div class="max-w-[1440px] w-full mx-auto px-4 md:px-8 py-8 flex flex-col gap-8">
    <header class="flex flex-col gap-4 reveal">
        <nav aria-label="Breadcrumb" class="text-sm font-label text-on-surface-variant flex items-center gap-2">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Trang chủ</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-medium">Đơn hàng của tôi</span>
        </nav>
        <h1 class="text-luxury text-4xl md:text-6xl text-on-background tracking-tight">Đơn hàng của tôi</h1>
        <p class="font-body text-on-surface-variant">Theo dõi và quản lý các đơn hàng đã đặt</p>
    </header>

    @if($orders->count() > 0)
        <div class="flex flex-col gap-6">
            @foreach($orders as $index => $order)
            <div class="reveal stagger-{{ ($index % 4) + 1 }}">
                <div class="bg-surface-container-low rounded-xl border border-outline-variant/10 hover:border-outline-variant/20 transition-all duration-300 overflow-hidden">
                    {{-- Order Header --}}
                    <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-outline-variant/10">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-primary text-2xl">receipt_long</span>
                            </div>
                            <div>
                                <p class="font-headline font-bold text-on-background text-lg">{{ $order->code }}</p>
                                <p class="font-label text-sm text-on-surface-variant">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                    'processing' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'completed' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    'cancelled' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                ];
                                $statusLabels = [
                                    'pending' => 'Chờ xử lý',
                                    'processing' => 'Đang xử lý',
                                    'completed' => 'Hoàn thành',
                                    'cancelled' => 'Đã hủy',
                                ];
                                $color = $statusColors[$order->status] ?? $statusColors['pending'];
                                $label = $statusLabels[$order->status] ?? $order->status;
                            @endphp
                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider border {{ $color }}">{{ $label }}</span>
                        </div>
                    </div>

                    {{-- Order Items Preview --}}
                    <div class="p-6">
                        <div class="flex flex-col gap-4">
                            @foreach($order->orderDetails->take(3) as $detail)
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-lg bg-surface-container-high overflow-hidden flex-shrink-0">
                                    @if($detail->product)
                                        <img alt="{{ $detail->product->name }}" class="w-full h-full object-cover" src="{{ $detail->product->image ?: '' }}"/>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-on-surface-variant">image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <p class="font-headline font-semibold text-on-background truncate">{{ $detail->product->name ?? 'Sản phẩm đã xóa' }}</p>
                                    <p class="font-label text-sm text-on-surface-variant">SL: {{ $detail->quantity }} × {{ number_format($detail->price, 0, ',', '.') }} VNĐ</p>
                                </div>
                                <p class="font-headline font-bold text-primary whitespace-nowrap">{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }} VNĐ</p>
                            </div>
                            @endforeach
                            @if($order->orderDetails->count() > 3)
                                <p class="font-label text-sm text-on-surface-variant text-center">và {{ $order->orderDetails->count() - 3 }} sản phẩm khác...</p>
                            @endif
                        </div>
                    </div>

                    {{-- Order Footer --}}
                    <div class="px-6 py-4 bg-surface-container-lowest/50 flex flex-col md:flex-row md:items-center justify-between gap-4 border-t border-outline-variant/10">
                        <div class="flex items-center gap-2">
                            <span class="font-body text-on-surface-variant text-sm">Tổng cộng:</span>
                            <span class="text-gradient font-headline font-bold text-xl">{{ number_format($order->orderDetails->sum(fn($d) => $d->quantity * $d->price), 0, ',', '.') }} VNĐ</span>
                        </div>
                        <a href="{{ route('order.show', $order->id) }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg border border-outline-variant/15 text-primary font-headline font-semibold text-sm uppercase tracking-wider hover:bg-primary/5 hover:border-primary/30 transition-all group">
                            Xem chi tiết
                            <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-center mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-24 reveal">
            <div class="w-24 h-24 rounded-full bg-surface-container-high flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-5xl text-on-surface-variant">shopping_bag</span>
            </div>
            <h2 class="text-luxury text-2xl md:text-3xl text-on-background mb-3">Chưa có đơn hàng nào</h2>
            <p class="font-body text-on-surface-variant mb-8 max-w-md mx-auto">Hãy khám phá bộ sưu tập xe của chúng tôi và đặt đơn hàng đầu tiên.</p>
            <a href="{{ route('category.index') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-primary-container to-primary/80 text-white font-headline font-bold px-8 py-4 rounded-lg hover:shadow-[0_0_40px_rgba(182,196,255,0.3)] transition-all duration-300">
                Khám phá ngay
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    @endif
</div>
@endsection
