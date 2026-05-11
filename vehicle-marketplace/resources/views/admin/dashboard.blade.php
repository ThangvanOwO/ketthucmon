@extends('admin.layout')
@section('title', 'KINETIC Admin - Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-bg-card rounded-xl border border-border-color p-6 hover:border-accent/30 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-accent-light">inventory_2</span>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-text-muted hover:text-text-primary transition-colors">Xem →</a>
        </div>
        <p class="text-3xl font-heading font-bold text-white">{{ $stats['products'] }}</p>
        <p class="text-xs text-text-muted mt-1 uppercase tracking-wider">Sản phẩm</p>
    </div>
    <div class="bg-bg-card rounded-xl border border-border-color p-6 hover:border-warning/30 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-warning/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-warning">receipt_long</span>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-text-muted hover:text-text-primary transition-colors">Xem →</a>
        </div>
        <p class="text-3xl font-heading font-bold text-white">{{ $stats['orders'] }}</p>
        <p class="text-xs text-text-muted mt-1 uppercase tracking-wider">Đơn hàng</p>
    </div>
    <div class="bg-bg-card rounded-xl border border-border-color p-6 hover:border-success/30 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-success/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-success">group</span>
            </div>
        </div>
        <p class="text-3xl font-heading font-bold text-white">{{ $stats['users'] }}</p>
        <p class="text-xs text-text-muted mt-1 uppercase tracking-wider">Người dùng</p>
    </div>
    <div class="bg-bg-card rounded-xl border border-border-color p-6 hover:border-danger/30 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-danger/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-danger">pending_actions</span>
            </div>
        </div>
        <p class="text-3xl font-heading font-bold text-white">{{ $stats['pendingOrders'] }}</p>
        <p class="text-xs text-text-muted mt-1 uppercase tracking-wider">Chờ xử lý</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Recent Orders --}}
    <div class="bg-bg-card rounded-xl border border-border-color">
        <div class="p-6 border-b border-border-color flex items-center justify-between">
            <h2 class="font-heading font-bold text-white">Đơn hàng gần đây</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-accent-light hover:underline">Xem tất cả</a>
        </div>
        <div class="divide-y divide-border-color">
            @forelse($recentOrders as $order)
            <a href="{{ route('admin.orders.show', $order->id) }}" class="flex items-center justify-between p-4 hover:bg-bg-card-hover transition-colors">
                <div>
                    <p class="font-heading font-semibold text-white text-sm">{{ $order->code }}</p>
                    <p class="text-xs text-text-muted mt-0.5">{{ $order->user->email ?? 'N/A' }} · {{ $order->created_at->diffForHumans() }}</p>
                </div>
                <div class="text-right">
                    @php
                        $colors = ['pending'=>'text-warning','processing'=>'text-accent-light','completed'=>'text-success','cancelled'=>'text-danger'];
                        $labels = ['pending'=>'Chờ','processing'=>'Đang XL','completed'=>'Xong','cancelled'=>'Hủy'];
                    @endphp
                    <span class="text-xs font-bold uppercase {{ $colors[$order->status] ?? 'text-text-muted' }}">{{ $labels[$order->status] ?? $order->status }}</span>
                    <p class="text-sm font-bold text-white mt-0.5">{{ number_format($order->orderDetails->sum(fn($d) => $d->quantity * $d->price), 0, ',', '.') }}đ</p>
                </div>
            </a>
            @empty
            <div class="p-8 text-center text-text-muted text-sm">Chưa có đơn hàng nào</div>
            @endforelse
        </div>
    </div>

    {{-- Top Products --}}
    <div class="bg-bg-card rounded-xl border border-border-color">
        <div class="p-6 border-b border-border-color flex items-center justify-between">
            <h2 class="font-heading font-bold text-white">Sản phẩm nổi bật</h2>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-accent-light hover:underline">Xem tất cả</a>
        </div>
        <div class="divide-y divide-border-color">
            @foreach($topProducts as $product)
            <div class="flex items-center gap-4 p-4 hover:bg-bg-card-hover transition-colors">
                <div class="w-12 h-12 rounded-lg bg-bg-dark overflow-hidden flex-shrink-0">
                    <img alt="{{ $product->name }}" class="w-full h-full object-cover" src="{{ $product->image ?: '' }}"/>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-heading font-semibold text-white text-sm truncate">{{ $product->name }}</p>
                    <p class="text-xs text-text-muted">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-accent-light">{{ $product->view }}</p>
                    <p class="text-xs text-text-muted">lượt xem</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
