@extends('admin.layout')
@section('title', 'KINETIC Admin - Đơn hàng ' . $order->code)
@section('page-title', 'Chi tiết đơn hàng')

@section('content')
<a href="{{ route('admin.orders.index') }}" class="text-text-muted hover:text-text-primary text-sm flex items-center gap-1 mb-6 transition-colors">
    <span class="material-symbols-outlined text-lg">arrow_back</span>
    Quay lại danh sách
</a>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Order Info --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Order Items --}}
        <div class="bg-bg-card rounded-xl border border-border-color overflow-hidden">
            <div class="p-6 border-b border-border-color">
                <h2 class="font-heading font-bold text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-accent-light">list_alt</span>
                    Sản phẩm trong đơn
                </h2>
            </div>
            <div class="divide-y divide-border-color">
                @foreach($order->orderDetails as $detail)
                <div class="flex items-center gap-4 p-5 hover:bg-bg-card-hover transition-colors">
                    <div class="w-14 h-14 rounded-lg bg-bg-dark overflow-hidden flex-shrink-0">
                        @if($detail->product)
                            <img alt="{{ $detail->product->name }}" class="w-full h-full object-cover" src="{{ $detail->product->image ?: '' }}"/>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-text-muted">image</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-white">{{ $detail->product->name ?? 'Đã xóa' }}</p>
                        <p class="text-xs text-text-muted mt-0.5">{{ number_format($detail->price, 0, ',', '.') }}đ × {{ $detail->quantity }}</p>
                    </div>
                    <p class="font-heading font-bold text-white">{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}đ</p>
                </div>
                @endforeach
            </div>
            <div class="p-6 border-t border-border-color bg-bg-dark/50 flex justify-between items-center">
                <span class="text-text-muted font-semibold">Tổng cộng</span>
                <span class="text-2xl font-heading font-bold text-accent-light">{{ number_format($order->orderDetails->sum(fn($d) => $d->quantity * $d->price), 0, ',', '.') }}đ</span>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-6">
        {{-- Order Summary --}}
        <div class="bg-bg-card rounded-xl border border-border-color p-6 space-y-5">
            <h3 class="font-heading font-bold text-white">Thông tin đơn</h3>
            <div class="space-y-4 text-sm">
                <div class="flex justify-between">
                    <span class="text-text-muted">Mã đơn</span>
                    <span class="font-semibold text-white">{{ $order->code }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-text-muted">Ngày đặt</span>
                    <span class="text-white">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-text-muted">Khách hàng</span>
                    <span class="text-white">{{ $order->user->email ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-text-muted">Trạng thái</span>
                    @php
                        $statusColors = ['pending'=>'bg-warning/10 text-warning border-warning/20','processing'=>'bg-accent/10 text-accent-light border-accent/20','completed'=>'bg-success/10 text-success border-success/20','cancelled'=>'bg-danger/10 text-danger border-danger/20'];
                        $statusLabels = ['pending'=>'Chờ xử lý','processing'=>'Đang xử lý','completed'=>'Hoàn thành','cancelled'=>'Đã hủy'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$order->status] ?? '' }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
                </div>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="bg-bg-card rounded-xl border border-border-color p-6">
            <h3 class="font-heading font-bold text-white mb-4">Cập nhật trạng thái</h3>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="space-y-4">
                @csrf @method('PATCH')
                <select name="status" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
                <button type="submit" class="w-full bg-accent hover:bg-accent-light text-white font-semibold py-3 rounded-lg text-sm transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">update</span>
                    Cập nhật
                </button>
            </form>
        </div>

        {{-- Danger Zone --}}
        <div class="bg-bg-card rounded-xl border border-danger/20 p-6">
            <h3 class="font-heading font-bold text-danger mb-4">Vùng nguy hiểm</h3>
            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa đơn hàng này? Hành động không thể hoàn tác!')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full bg-danger/10 hover:bg-danger/20 text-danger font-semibold py-3 rounded-lg text-sm border border-danger/20 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">delete_forever</span>
                    Xóa đơn hàng
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
