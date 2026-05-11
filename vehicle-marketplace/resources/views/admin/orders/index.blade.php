@extends('admin.layout')
@section('title', 'KINETIC Admin - Đơn hàng')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
{{-- Toolbar --}}
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <form class="flex items-center gap-3" method="GET">
        <div class="relative">
            <input name="search" value="{{ request('search') }}" class="bg-bg-card border border-border-color text-white text-sm rounded-lg pl-10 pr-4 py-2.5 w-64 focus:ring-1 focus:ring-accent focus:border-accent placeholder-text-muted" placeholder="Tìm mã đơn hàng..."/>
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-lg">search</span>
        </div>
        <select name="status" class="bg-bg-card border border-border-color text-white text-sm rounded-lg px-4 py-2.5 focus:ring-1 focus:ring-accent focus:border-accent">
            <option value="">Tất cả trạng thái</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
        </select>
        <button type="submit" class="bg-accent/10 text-accent-light px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-accent/20 transition-colors">Lọc</button>
    </form>
</div>

{{-- Table --}}
<div class="bg-bg-card rounded-xl border border-border-color overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-border-color text-text-muted text-xs uppercase tracking-wider">
                    <th class="text-left px-6 py-4">Mã đơn</th>
                    <th class="text-left px-6 py-4">Khách hàng</th>
                    <th class="text-left px-6 py-4">Trạng thái</th>
                    <th class="text-right px-6 py-4">Sản phẩm</th>
                    <th class="text-right px-6 py-4">Tổng tiền</th>
                    <th class="text-left px-6 py-4">Ngày đặt</th>
                    <th class="text-right px-6 py-4">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-color">
                @forelse($orders as $order)
                @php
                    $statusColors = ['pending'=>'bg-warning/10 text-warning border-warning/20','processing'=>'bg-accent/10 text-accent-light border-accent/20','completed'=>'bg-success/10 text-success border-success/20','cancelled'=>'bg-danger/10 text-danger border-danger/20'];
                    $statusLabels = ['pending'=>'Chờ xử lý','processing'=>'Đang xử lý','completed'=>'Hoàn thành','cancelled'=>'Đã hủy'];
                @endphp
                <tr class="hover:bg-bg-card-hover transition-colors">
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="font-semibold text-accent-light hover:underline">{{ $order->code }}</a>
                    </td>
                    <td class="px-6 py-4 text-text-muted">{{ $order->user->email ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$order->status] ?? '' }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
                    </td>
                    <td class="px-6 py-4 text-right text-text-muted">{{ $order->orderDetails->count() }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-white">{{ number_format($order->orderDetails->sum(fn($d) => $d->quantity * $d->price), 0, ',', '.') }}đ</td>
                    <td class="px-6 py-4 text-text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-accent-light hover:text-white p-1.5 rounded-lg hover:bg-accent/10 transition-colors" title="Chi tiết">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Xóa đơn hàng này?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-danger hover:text-white p-1.5 rounded-lg hover:bg-danger/10 transition-colors" title="Xóa">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-text-muted">Không tìm thấy đơn hàng nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection
