@extends('admin.layout')
@section('title', 'KINETIC Admin - Sửa sản phẩm')
@section('page-title', 'Sửa sản phẩm')

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.products.index') }}" class="text-text-muted hover:text-text-primary text-sm flex items-center gap-1 mb-6 transition-colors">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Quay lại danh sách
    </a>

    <div class="bg-bg-card rounded-xl border border-border-color p-8">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent" required/>
                    @error('name') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Danh mục <span class="text-danger">*</span></label>
                    <select name="category_id" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Mô tả</label>
                    <textarea name="description" rows="4" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent resize-none">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Main Image --}}
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Ảnh chính</label>
                    <div class="space-y-3">
                        @if($product->image)
                        <div class="mb-3">
                            <p class="text-xs text-text-muted mb-2">Ảnh hiện tại:</p>
                            <img src="{{ $product->image }}" alt="Current" class="w-32 h-32 object-cover rounded-lg border border-border-color"/>
                        </div>
                        @endif
                        <div>
                            <label class="block text-xs text-text-muted mb-1">Upload ảnh mới (thay thế)</label>
                            <input type="file" name="image" accept="image/*" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent file:text-white hover:file:bg-accent-light"/>
                            @error('image') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs text-text-muted mb-1">Hoặc nhập URL hình ảnh</label>
                            <input type="text" name="image_url" value="{{ old('image_url', $product->image) }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent"/>
                            @error('image_url') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Existing Gallery Images --}}
                @php
                    $galleryMedia = $product->getMedia('gallery');
                @endphp
                @if($galleryMedia->count() > 0)
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Thư viện ảnh hiện tại ({{ $galleryMedia->count() }} ảnh)</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($galleryMedia as $media)
                        <div class="relative group" id="media-{{ $media->id }}">
                            <img src="{{ $media->getUrl('thumb') }}" alt="{{ $media->name }}" class="w-24 h-24 object-cover rounded-lg border border-border-color"/>
                            <form action="{{ route('admin.products.deleteGalleryImage', $product->id) }}" method="POST" class="absolute -top-2 -right-2" onsubmit="return confirm('Xóa ảnh này?')">
                                @csrf @method('DELETE')
                                <input type="hidden" name="media_id" value="{{ $media->id }}"/>
                                <button type="submit" class="w-6 h-6 bg-danger rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Upload New Gallery Images --}}
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Thêm ảnh vào thư viện</label>
                    <input type="file" name="gallery_images[]" accept="image/*" multiple class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent file:text-white hover:file:bg-accent-light"/>
                    <p class="text-xs text-text-muted mt-1">Chọn nhiều ảnh cùng lúc. Hỗ trợ JPEG, PNG, GIF, WebP. Tối đa 5MB/ảnh.</p>
                    @error('gallery_images') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    @error('gallery_images.*') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    <div id="gallery-preview" class="flex flex-wrap gap-2 mt-3"></div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Giá (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent" min="0" required/>
                        @error('price') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Số lượng <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full bg-bg-dark border border-border-color text-white rounded-lg px-4 py-3 text-sm focus:ring-1 focus:ring-accent focus:border-accent" min="0" required/>
                        @error('quantity') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-border-color">
                    <button type="submit" class="bg-accent hover:bg-accent-light text-white font-semibold px-6 py-3 rounded-lg text-sm flex items-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-lg">save</span>
                        Lưu thay đổi
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
