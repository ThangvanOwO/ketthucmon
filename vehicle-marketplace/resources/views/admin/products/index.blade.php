@extends('admin.layout')
@section('title', 'KINETIC Admin - Sản phẩm')
@section('page-title', 'Quản lý sản phẩm')

@section('content')
{{-- Toolbar --}}
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <form class="flex items-center gap-3" method="GET">
        <div class="relative">
            <input name="search" value="{{ request('search') }}" class="bg-bg-card border border-border-color text-white text-sm rounded-lg pl-10 pr-4 py-2.5 w-64 focus:ring-1 focus:ring-accent focus:border-accent placeholder-text-muted" placeholder="Tìm sản phẩm..."/>
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-lg">search</span>
        </div>
        <select name="category" class="bg-bg-card border border-border-color text-white text-sm rounded-lg px-4 py-2.5 focus:ring-1 focus:ring-accent focus:border-accent">
            <option value="">Tất cả danh mục</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-accent/10 text-accent-light px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-accent/20 transition-colors">Lọc</button>
    </form>
    <a href="{{ route('admin.products.create') }}" class="bg-accent hover:bg-accent-light text-white font-semibold px-5 py-2.5 rounded-lg text-sm flex items-center gap-2 transition-colors w-fit">
        <span class="material-symbols-outlined text-lg">add</span>
        Thêm sản phẩm
    </a>
</div>

{{-- Table --}}
<div class="bg-bg-card rounded-xl border border-border-color overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-border-color text-text-muted text-xs uppercase tracking-wider">
                    <th class="text-left px-6 py-4">Sản phẩm</th>
                    <th class="text-left px-6 py-4">Danh mục</th>
                    <th class="text-right px-6 py-4">Giá</th>
                    <th class="text-right px-6 py-4">Tồn kho</th>
                    <th class="text-right px-6 py-4">Lượt xem</th>
                    <th class="text-right px-6 py-4">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-color">
                @forelse($products as $product)
                <tr class="hover:bg-bg-card-hover transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-bg-dark overflow-hidden flex-shrink-0">
                                <img alt="{{ $product->name }}" class="w-full h-full object-cover" src="{{ $product->image ?: '' }}"/>
                            </div>
                            <div>
                                <p class="font-semibold text-white">{{ $product->name }}</p>
                                <p class="text-xs text-text-muted">{{ $product->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-text-muted">{{ $product->category->name ?? '—' }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-white">{{ number_format($product->price, 0, ',', '.') }}đ</td>
                    <td class="px-6 py-4 text-right">
                        <span class="{{ $product->quantity <= 5 ? 'text-danger' : 'text-success' }} font-semibold">{{ $product->quantity }}</span>
                    </td>
                    <td class="px-6 py-4 text-right text-text-muted">{{ $product->view }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-accent-light hover:text-white p-1.5 rounded-lg hover:bg-accent/10 transition-colors" title="Sửa">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này?')">
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
                    <td colspan="6" class="px-6 py-12 text-center text-text-muted">Không tìm thấy sản phẩm nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection
