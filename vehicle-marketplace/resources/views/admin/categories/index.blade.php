@extends('admin.layout')
@section('title', 'KINETIC Admin - Danh mục')
@section('page-title', 'Quản lý danh mục')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Add Category --}}
    <div>
        <div class="bg-bg-card rounded-xl border border-border-color p-6">
            <h2 class="font-heading font-bold text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-accent-light">add_circle</span>
                Thêm danh mục
            </h2>
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Tên danh mục</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent placeholder-text-muted" placeholder="Nhập tên danh mục..." required/>
                    @error('name') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full bg-accent hover:bg-accent-light text-white font-semibold py-3 rounded-lg text-sm transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">add</span>
                    Thêm
                </button>
            </form>
        </div>
    </div>

    {{-- Categories List --}}
    <div class="lg:col-span-2">
        <div class="bg-bg-card rounded-xl border border-border-color overflow-hidden">
            <div class="p-6 border-b border-border-color">
                <h2 class="font-heading font-bold text-white">Danh sách danh mục ({{ $categories->count() }})</h2>
            </div>
            <div class="divide-y divide-border-color">
                @forelse($categories as $cat)
                <div class="p-5 hover:bg-bg-card-hover transition-colors group" id="cat-{{ $cat->id }}">
                    {{-- Display Mode --}}
                    <div class="flex items-center justify-between" id="display-{{ $cat->id }}">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-accent-light">category</span>
                            </div>
                            <div>
                                <p class="font-semibold text-white">{{ $cat->name }}</p>
                                <p class="text-xs text-text-muted">{{ $cat->products_count }} sản phẩm</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="toggleEdit({{ $cat->id }})" class="text-accent-light hover:text-white p-1.5 rounded-lg hover:bg-accent/10 transition-colors" title="Sửa">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </button>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Xóa danh mục này?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-danger hover:text-white p-1.5 rounded-lg hover:bg-danger/10 transition-colors" title="Xóa">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- Edit Mode --}}
                    <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST" class="hidden mt-3" id="edit-{{ $cat->id }}">
                        @csrf @method('PUT')
                        <div class="flex items-center gap-3">
                            <input type="text" name="name" value="{{ $cat->name }}" class="flex-1 bg-bg-dark border border-border-color text-white rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-accent focus:border-accent" required/>
                            <button type="submit" class="bg-accent hover:bg-accent-light text-white font-semibold px-4 py-2.5 rounded-lg text-sm transition-colors">Lưu</button>
                            <button type="button" onclick="toggleEdit({{ $cat->id }})" class="text-text-muted hover:text-white px-4 py-2.5 rounded-lg text-sm transition-colors">Hủy</button>
                        </div>
                    </form>
                </div>
                @empty
                <div class="p-8 text-center text-text-muted text-sm">Chưa có danh mục nào</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
function toggleEdit(id) {
    const display = document.getElementById('display-' + id);
    const edit = document.getElementById('edit-' + id);
    display.classList.toggle('hidden');
    edit.classList.toggle('hidden');
}
</script>
@endsection
