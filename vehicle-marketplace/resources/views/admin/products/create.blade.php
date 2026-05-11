@extends('admin.layout')
@section('title', 'KINETIC Admin - Thêm sản phẩm')
@section('page-title', 'Thêm sản phẩm mới')

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.products.index') }}" class="text-text-muted hover:text-text-primary text-sm flex items-center gap-1 mb-6 transition-colors">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Quay lại danh sách
    </a>

    <div class="bg-bg-card rounded-xl border border-border-color p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent placeholder-text-muted" placeholder="Nhập tên sản phẩm..." required/>
                    @error('name') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Danh mục <span class="text-danger">*</span></label>
                    <select name="category_id" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent" required>
                        <option value="">Chọn danh mục</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Mô tả</label>
                    <textarea name="description" rows="4" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent placeholder-text-muted resize-none" placeholder="Nhập mô tả sản phẩm...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Main Image --}}
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Ảnh chính</label>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-text-muted mb-1">Upload từ máy tính</label>
                            <input type="file" name="image" accept="image/*" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent file:text-white hover:file:bg-accent-light"/>
                            @error('image') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs text-text-muted mb-1">Hoặc nhập URL hình ảnh</label>
                            <input type="text" name="image_url" value="{{ old('image_url') }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent placeholder-text-muted" placeholder="https://example.com/image.jpg"/>
                            @error('image_url') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Gallery Images --}}
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Thư viện ảnh (tối đa 10 ảnh)</label>
                    <input type="file" name="gallery_images[]" accept="image/*" multiple class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent file:text-white hover:file:bg-accent-light"/>
                    <p class="text-xs text-text-muted mt-1">Chọn nhiều ảnh cùng lúc. Hỗ trợ JPEG, PNG, GIF, WebP. Tối đa 5MB/ảnh.</p>
                    @error('gallery_images') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    @error('gallery_images.*') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    <div id="gallery-preview" class="flex flex-wrap gap-2 mt-3"></div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Giá (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" name="price" value="{{ old('price') }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent placeholder-text-muted" placeholder="0" min="0" required/>
                        @error('price') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Số lượng <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" value="{{ old('quantity', 0) }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent placeholder-text-muted" placeholder="0" min="0" required/>
                        @error('quantity') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-border-color">
                    <button type="submit" class="bg-accent hover:bg-accent-light text-white font-semibold px-6 py-3 rounded-lg text-sm flex items-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-lg">add</span>
                        Thêm sản phẩm
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="text-text-muted hover:text-white px-6 py-3 rounded-lg text-sm transition-colors">Hủy</a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryInput = document.querySelector('input[name="gallery_images[]"]');
    const preview = document.getElementById('gallery-preview');

    if (galleryInput && preview) {
        galleryInput.addEventListener('change', function() {
            preview.innerHTML = '';
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative w-20 h-20 rounded-lg overflow-hidden border border-border-color';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover"/>`;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    }
});
</script>
@endpush
@endsection
