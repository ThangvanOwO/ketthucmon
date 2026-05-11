@extends('layouts.app')
@section('title', 'KINETIC - Đơn hàng ' . $order->code)

@section('content')
<div class="max-w-[1000px] w-full mx-auto px-4 md:px-8 py-8 flex flex-col gap-8">
    {{-- Breadcrumb --}}
    <header class="flex flex-col gap-4 reveal">
        <nav aria-label="Breadcrumb" class="text-sm font-label text-on-surface-variant flex items-center gap-2">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Trang chủ</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('order.index') }}">Đơn hàng</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-medium">{{ $order->code }}</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h1 class="text-luxury text-3xl md:text-5xl text-on-background tracking-tight">Chi tiết đơn hàng</h1>
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
            <span class="px-5 py-2 rounded-full text-sm font-bold uppercase tracking-wider border {{ $color }} w-fit">{{ $label }}</span>
        </div>
    </header>

    {{-- Customer & Payment Info --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 reveal stagger-1">
        <div class="bg-surface-container-low rounded-xl border border-outline-variant/10 p-6">
            <h3 class="font-headline font-bold text-on-background mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-xl">person</span>
                Thông tin giao hàng
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-on-surface-variant/50 text-lg">person</span>
                    <div>
                        <p class="text-on-surface-variant text-xs">Họ tên</p>
                        <p class="text-on-surface font-semibold">{{ $order->customer_name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-on-surface-variant/50 text-lg">phone</span>
                    <div>
                        <p class="text-on-surface-variant text-xs">Điện thoại</p>
                        <p class="text-on-surface font-semibold">{{ $order->phone ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-on-surface-variant/50 text-lg">mail</span>
                    <div>
                        <p class="text-on-surface-variant text-xs">Email</p>
                        <p class="text-on-surface font-semibold">{{ $order->email ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-on-surface-variant/50 text-lg">location_on</span>
                    <div>
                        <p class="text-on-surface-variant text-xs">Địa chỉ</p>
                        <p class="text-on-surface font-semibold">{{ $order->address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-surface-container-low rounded-xl border border-outline-variant/10 p-6">
            <h3 class="font-headline font-bold text-on-background mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary text-xl">payments</span>
                Thanh toán
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-on-surface-variant/50 text-lg">receipt</span>
                    <div>
                        <p class="text-on-surface-variant text-xs">Phương thức</p>
                        <p class="text-on-surface font-semibold">
                            @if(($order->payment_method ?? 'cod') === 'cod')
                                <span class="inline-flex items-center gap-1.5 bg-primary/10 text-primary px-2 py-0.5 rounded-full text-xs">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span> COD
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-tertiary/10 text-tertiary px-2 py-0.5 rounded-full text-xs">
                                    <span class="w-1.5 h-1.5 bg-tertiary rounded-full"></span> Chuyển khoản
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
                @if($order->note)
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-on-surface-variant/50 text-lg">note</span>
                    <div>
                        <p class="text-on-surface-variant text-xs">Ghi chú</p>
                        <p class="text-on-surface font-semibold">{{ $order->note }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Order Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 reveal stagger-2">
        <div class="bg-surface-container-low rounded-xl border border-outline-variant/10 p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-primary">tag</span>
            </div>
            <div>
                <p class="font-label text-xs text-on-surface-variant uppercase tracking-wider">Mã đơn hàng</p>
                <p class="font-headline font-bold text-on-background">{{ $order->code }}</p>
            </div>
        </div>
        <div class="bg-surface-container-low rounded-xl border border-outline-variant/10 p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-tertiary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-tertiary">calendar_today</span>
            </div>
            <div>
                <p class="font-label text-xs text-on-surface-variant uppercase tracking-wider">Ngày đặt</p>
                <p class="font-headline font-bold text-on-background">{{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        <div class="bg-surface-container-low rounded-xl border border-outline-variant/10 p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-primary">inventory_2</span>
            </div>
            <div>
                <p class="font-label text-xs text-on-surface-variant uppercase tracking-wider">Số sản phẩm</p>
                <p class="font-headline font-bold text-on-background">{{ $order->orderDetails->count() }} sản phẩm</p>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="bg-surface-container-low rounded-xl border border-outline-variant/10 overflow-hidden reveal stagger-2">
        <div class="p-6 border-b border-outline-variant/10">
            <h2 class="font-headline text-xl font-bold text-on-background flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">list_alt</span>
                Sản phẩm đã đặt
            </h2>
        </div>
        <div class="divide-y divide-outline-variant/10">
            @foreach($order->orderDetails as $detail)
            <div class="p-6 flex items-center gap-5 hover:bg-surface-container/50 transition-colors">
                <div class="w-20 h-20 rounded-xl bg-surface-container-high overflow-hidden flex-shrink-0">
                    @if($detail->product)
                        <a href="{{ route('product.show', $detail->product->slug) }}">
                            <img alt="{{ $detail->product->name }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500" src="{{ $detail->product->image ?: '' }}"/>
                        </a>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-surface-variant text-2xl">image</span>
                        </div>
                    @endif
                </div>
                <div class="flex-grow min-w-0">
                    @if($detail->product)
                        <a href="{{ route('product.show', $detail->product->slug) }}" class="font-headline font-bold text-on-background text-lg hover:text-primary transition-colors">{{ $detail->product->name }}</a>
                        <p class="font-label text-sm text-on-surface-variant mt-1">{{ $detail->product->category->name ?? '' }}</p>
                    @else
                        <p class="font-headline font-bold text-on-surface-variant text-lg">Sản phẩm đã xóa</p>
                    @endif
                    <div class="flex items-center gap-4 mt-2">
                        <span class="font-label text-sm text-on-surface-variant">Đơn giá: <span class="text-on-surface font-semibold">{{ number_format($detail->price, 0, ',', '.') }} VNĐ</span></span>
                        <span class="text-outline-variant">×</span>
                        <span class="font-label text-sm text-on-surface-variant">SL: <span class="text-on-surface font-semibold">{{ $detail->quantity }}</span></span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-gradient font-headline font-bold text-lg">{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }} VNĐ</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Order Total --}}
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/10 p-6 reveal stagger-3">
        <div class="flex flex-col gap-3">
            <div class="flex justify-between items-center text-on-surface-variant font-label">
                <span>Tạm tính ({{ $order->orderDetails->sum('quantity') }} sản phẩm)</span>
                <span class="text-on-surface">{{ number_format($order->orderDetails->sum(fn($d) => $d->quantity * $d->price), 0, ',', '.') }} VNĐ</span>
            </div>
            <div class="flex justify-between items-center text-on-surface-variant font-label">
                <span>Phí vận chuyển</span>
                <span class="text-green-400 font-semibold">Miễn phí</span>
            </div>
            <div class="glow-line my-2"></div>
            <div class="flex justify-between items-center">
                <span class="font-headline font-bold text-on-background text-lg">Tổng cộng</span>
                <span class="text-luxury text-3xl text-gradient">{{ number_format($order->orderDetails->sum(fn($d) => $d->quantity * $d->price), 0, ',', '.') }} VNĐ</span>
            </div>
        </div>
    </div>

    {{-- Back Button --}}
    <div class="flex justify-between items-center reveal stagger-4">
        <a href="{{ route('order.index') }}" class="inline-flex items-center gap-2 text-on-surface-variant hover:text-primary font-headline font-medium transition-colors group">
            <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
            Quay lại danh sách
        </a>
        <a href="{{ route('category.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg border border-outline-variant/15 text-primary font-headline font-semibold text-sm uppercase tracking-wider hover:bg-primary/5 hover:border-primary/30 transition-all">
            Tiếp tục mua sắm
        </a>
    </div>
</div>
@endsection
