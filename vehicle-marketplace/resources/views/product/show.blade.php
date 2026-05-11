@extends('layouts.app')
@section('title', $product->name . ' | KINETIC')

@section('content')
{{-- 1. HERO SECTION - Full width --}}
<section id="section-intro" class="relative w-full h-[70vh] md:h-[85vh] bg-surface-container-lowest overflow-hidden">
    <img alt="{{ $product->name }}" class="w-full h-full object-cover object-center" src="{{ $product->image ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDAdSUcPXcI-u__GNSfEullPa39Am1OGT-XX2P-V6TZ3DgDERIRl8IAC0DpZf224wrWl8lhU-LZ4qHwEAkl-KHsbXcnbKhD22o1f13RKub3Fho5Vfp88nb_Ld5vBMHH7w5N1yTBiEeLek5DahZFvDkJqFwxISdMD7BT2sq3yCf_wMl1NXJ11VRcI9rlQpgChUkiiNEz7UefX6nGBL4hlccnirl0qfUUHGzrwg8GWHVH_pT3wPgOwVMKljlVHlsqmljEEEROPobEQ3w2' }}"/>
    <div class="absolute inset-0 bg-gradient-to-t from-background via-background/50 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-background/60 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-8 md:p-16 max-w-[1440px] mx-auto">
        <nav class="text-sm font-label text-on-surface-variant flex items-center gap-2 mb-6">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Trang chủ</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('category.show', $product->category_id) }}">{{ $product->category->name ?? '' }}</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-primary">{{ $product->name }}</span>
        </nav>
        <p class="font-label text-tertiary tracking-[0.3em] text-xs uppercase mb-3 font-bold">{{ $product->category->name ?? '' }}</p>
        <h1 class="font-headline text-5xl md:text-8xl font-bold tracking-tighter text-on-background leading-none mb-4">{{ $product->name }}</h1>
        <p class="font-body text-on-surface-variant text-lg md:text-xl max-w-2xl">{{ $product->description }}</p>
    </div>
</section>

{{-- 2. STICKY TAB NAVIGATION --}}
<nav id="product-tabs" class="sticky top-[72px] z-40 bg-surface-container-lowest/95 backdrop-blur-xl border-b border-outline-variant/10 shadow-[0_4px_20px_rgba(0,0,0,0.3)]">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 flex items-center overflow-x-auto scrollbar-hide">
        <a href="#section-intro" class="tab-link active whitespace-nowrap px-5 py-4 font-headline text-sm font-medium tracking-wide text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-all duration-300" data-section="section-intro">Giới thiệu</a>
        <a href="#section-price" class="tab-link whitespace-nowrap px-5 py-4 font-headline text-sm font-medium tracking-wide text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-all duration-300" data-section="section-price">Giá & Màu sắc</a>
        <a href="#section-features" class="tab-link whitespace-nowrap px-5 py-4 font-headline text-sm font-medium tracking-wide text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-all duration-300" data-section="section-features">Tính năng nổi bật</a>
        <a href="#section-specs" class="tab-link whitespace-nowrap px-5 py-4 font-headline text-sm font-medium tracking-wide text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-all duration-300" data-section="section-specs">Thông số kỹ thuật</a>
        <a href="#section-gallery" class="tab-link whitespace-nowrap px-5 py-4 font-headline text-sm font-medium tracking-wide text-on-surface-variant hover:text-primary border-b-2 border-transparent transition-all duration-300" data-section="section-gallery">Thư viện</a>
        {{-- CTA buttons on right --}}
        <div class="ml-auto flex items-center gap-3 pl-6">
            @if($product->quantity > 0)
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex items-center gap-2">
                @csrf
                <input type="hidden" name="quantity" value="1"/>
                <button type="submit" class="bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold text-xs tracking-wider px-6 py-2.5 rounded-sm hover:opacity-90 transition-opacity flex items-center gap-2 whitespace-nowrap">
                    <span class="material-symbols-outlined text-base">shopping_cart</span>
                    THÊM VÀO GIỎ
                </button>
            </form>
            @endif
        </div>
    </div>
</nav>

{{-- 3. GIÁ & MÀU SẮC --}}
<section id="section-price" class="bg-surface py-20 md:py-28">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8">
        <div class="text-center mb-16">
            <h2 class="font-headline text-3xl md:text-5xl font-bold tracking-tight text-on-background mb-4">Giá & Màu sắc</h2>
            <p class="font-body text-on-surface-variant text-lg">Giá bán lẻ đề xuất</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- Price Card --}}
            <div class="relative">
                <div class="bg-surface-container-low rounded-xl p-10 md:p-14 relative overflow-hidden border border-outline-variant/10">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-primary/5 rounded-full blur-[80px]"></div>
                    <div class="relative z-10">
                        <p class="font-label text-tertiary tracking-[0.3em] text-xs uppercase mb-2 font-bold">GIÁ BÁN LẺ ĐỀ XUẤT</p>
                        <div class="flex items-baseline gap-2 mb-6">
                            <span class="font-headline text-5xl md:text-7xl font-bold text-primary tracking-tighter">{{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="font-headline text-2xl text-primary/70 font-medium">VNĐ</span>
                        </div>
                        <div class="flex flex-wrap gap-4 mb-8">
                            <div class="bg-surface-container-highest/50 px-4 py-2 rounded-lg">
                                <span class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Tồn kho</span>
                                <p class="font-headline text-lg font-bold text-on-background">{{ $product->quantity }} chiếc</p>
                            </div>
                            <div class="bg-surface-container-highest/50 px-4 py-2 rounded-lg">
                                <span class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Lượt xem</span>
                                <p class="font-headline text-lg font-bold text-on-background">{{ number_format($product->view) }}</p>
                            </div>
                            <div class="bg-surface-container-highest/50 px-4 py-2 rounded-lg">
                                <span class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Danh mục</span>
                                <p class="font-headline text-lg font-bold text-tertiary">{{ $product->category->name ?? '' }}</p>
                            </div>
                        </div>

                        {{-- Add to Cart --}}
                        @if($product->quantity > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                            @csrf
                            <div class="flex items-center bg-surface-container-highest rounded-lg border border-outline-variant/15 overflow-hidden">
                                <label class="px-4 font-label text-sm text-on-surface-variant whitespace-nowrap">Số lượng</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="w-20 bg-transparent border-none text-on-surface text-center focus:ring-0 font-headline font-bold text-lg"/>
                            </div>
                            <button type="submit" class="flex-1 bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold text-base py-4 px-8 rounded-lg flex justify-center items-center gap-3 hover:opacity-90 transition-all hover:shadow-[0_8px_32px_rgba(41,98,255,0.3)] group">
                                <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">shopping_cart</span>
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                        @else
                        <div class="bg-surface-container-highest text-on-surface-variant font-headline font-bold text-lg py-4 rounded-lg text-center flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">block</span> Tạm hết hàng
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Color Swatches --}}
            <div class="flex flex-col items-center gap-8">
                <div class="w-full aspect-[4/3] bg-surface-container-high rounded-xl overflow-hidden relative group">
                    <img id="color-preview-img" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $product->image ?: '' }}"/>
                </div>
                <div>
                    <p class="font-label text-on-surface-variant text-sm uppercase tracking-widest mb-4 text-center">Màu sắc có sẵn</p>
                    <div class="flex gap-3 justify-center flex-wrap">
                        <button class="w-10 h-10 rounded-full bg-[#1a1a2e] ring-2 ring-primary ring-offset-2 ring-offset-background transition-all hover:scale-110 color-swatch active" title="Đen Huyền Bí"></button>
                        <button class="w-10 h-10 rounded-full bg-[#f5f5f5] ring-2 ring-transparent ring-offset-2 ring-offset-background transition-all hover:scale-110 hover:ring-primary/50 color-swatch" title="Trắng Ngọc Trai"></button>
                        <button class="w-10 h-10 rounded-full bg-[#8B0000] ring-2 ring-transparent ring-offset-2 ring-offset-background transition-all hover:scale-110 hover:ring-primary/50 color-swatch" title="Đỏ Rực Rỡ"></button>
                        <button class="w-10 h-10 rounded-full bg-[#4a5568] ring-2 ring-transparent ring-offset-2 ring-offset-background transition-all hover:scale-110 hover:ring-primary/50 color-swatch" title="Xám Thép"></button>
                        <button class="w-10 h-10 rounded-full bg-[#2b4c7e] ring-2 ring-transparent ring-offset-2 ring-offset-background transition-all hover:scale-110 hover:ring-primary/50 color-swatch" title="Xanh Dương"></button>
                    </div>
                    <p id="color-name" class="text-center mt-3 font-label text-sm text-primary font-medium">Đen Huyền Bí</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. TÍNH NĂNG NỔI BẬT --}}
<section id="section-features" class="bg-surface-container-lowest py-20 md:py-28">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8">
        <div class="text-center mb-20">
            <p class="font-label text-tertiary tracking-[0.3em] text-xs uppercase mb-3 font-bold">HIGHLIGHTS</p>
            <h2 class="font-headline text-3xl md:text-5xl font-bold tracking-tight text-on-background">Tính năng nổi bật</h2>
        </div>

        {{-- Feature 1: Full width image + text --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 mb-1 rounded-xl overflow-hidden bg-surface-container-low">
            <div class="aspect-[4/3] lg:aspect-auto overflow-hidden">
                <img alt="Thiết kế ngoại thất" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" src="{{ $product->image ?: '' }}"/>
            </div>
            <div class="p-10 md:p-16 flex flex-col justify-center">
                <span class="material-symbols-outlined text-tertiary text-4xl mb-6">palette</span>
                <h3 class="font-headline text-2xl md:text-3xl font-bold text-on-background mb-4">Thiết kế ngoại thất</h3>
                <p class="font-body text-on-surface-variant text-base leading-relaxed mb-6">
                    Đường nét thiết kế mạnh mẽ, hiện đại với ngôn ngữ thiết kế đặc trưng. Mỗi chi tiết đều được chau chuốt tỉ mỉ, tạo nên vẻ ngoài sang trọng và thể thao.
                </p>
                <ul class="space-y-3 font-body text-sm text-on-surface-variant">
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Cụm đèn LED hiện đại, tinh tế</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Mâm xe hợp kim thiết kế thể thao</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Ăng-ten vây cá mập đồng điệu</li>
                </ul>
            </div>
        </div>

        {{-- Feature cards grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-1 mb-1">
            <div class="bg-surface-container-low p-8 md:p-10 flex flex-col group hover:bg-surface-container transition-colors duration-300 rounded-xl md:rounded-none">
                <span class="material-symbols-outlined text-tertiary text-4xl mb-6">speed</span>
                <h3 class="font-headline text-xl font-bold text-on-background mb-3">Hiệu suất vận hành</h3>
                <p class="font-body text-on-surface-variant text-sm leading-relaxed flex-grow">
                    Hệ thống động cơ được tối ưu hóa, mang lại sức mạnh vượt trội cùng khả năng tiết kiệm nhiên liệu ấn tượng.
                </p>
                <div class="mt-6 pt-6 border-t border-outline-variant/10">
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Công suất</span>
                        <span class="text-primary font-bold">Tối ưu</span>
                    </div>
                </div>
            </div>
            <div class="bg-surface-container-low p-8 md:p-10 flex flex-col group hover:bg-surface-container transition-colors duration-300 rounded-xl md:rounded-none">
                <span class="material-symbols-outlined text-tertiary text-4xl mb-6">shield</span>
                <h3 class="font-headline text-xl font-bold text-on-background mb-3">An toàn tiên tiến</h3>
                <p class="font-body text-on-surface-variant text-sm leading-relaxed flex-grow">
                    Trang bị các công nghệ an toàn hàng đầu, bảo vệ bạn và gia đình trong mọi hành trình di chuyển.
                </p>
                <div class="mt-6 pt-6 border-t border-outline-variant/10">
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Hệ thống</span>
                        <span class="text-primary font-bold">Toàn diện</span>
                    </div>
                </div>
            </div>
            <div class="bg-surface-container-low p-8 md:p-10 flex flex-col group hover:bg-surface-container transition-colors duration-300 rounded-xl md:rounded-none">
                <span class="material-symbols-outlined text-tertiary text-4xl mb-6">settings</span>
                <h3 class="font-headline text-xl font-bold text-on-background mb-3">Công nghệ thông minh</h3>
                <p class="font-body text-on-surface-variant text-sm leading-relaxed flex-grow">
                    Tích hợp hệ thống giải trí đa phương tiện, kết nối điện thoại thông minh, mang lại trải nghiệm hiện đại.
                </p>
                <div class="mt-6 pt-6 border-t border-outline-variant/10">
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Kết nối</span>
                        <span class="text-primary font-bold">Đa nền tảng</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Feature 2: Reversed layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-xl overflow-hidden bg-surface-container-low">
            <div class="p-10 md:p-16 flex flex-col justify-center order-2 lg:order-1">
                <span class="material-symbols-outlined text-tertiary text-4xl mb-6">airline_seat_recline_extra</span>
                <h3 class="font-headline text-2xl md:text-3xl font-bold text-on-background mb-4">Nội thất cao cấp</h3>
                <p class="font-body text-on-surface-variant text-base leading-relaxed mb-6">
                    Không gian nội thất được thiết kế lấy cảm hứng từ sự sang trọng, với chất liệu cao cấp và bố trí thông minh, tối ưu sự thoải mái cho mọi hành khách.
                </p>
                <ul class="space-y-3 font-body text-sm text-on-surface-variant">
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Ghế bọc da cao cấp, chỉnh điện</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Màn hình giải trí cảm ứng đa điểm</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Điều hòa tự động đa vùng</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Nhiều cổng sạc USB tiện lợi</li>
                </ul>
            </div>
            <div class="aspect-[4/3] lg:aspect-auto overflow-hidden order-1 lg:order-2">
                <img alt="Nội thất cao cấp" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" src="{{ $product->image ?: '' }}"/>
            </div>
        </div>
    </div>
</section>

{{-- 5. THÔNG SỐ KỸ THUẬT --}}
<section id="section-specs" class="bg-surface py-20 md:py-28">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8">
        <div class="text-center mb-16">
            <p class="font-label text-tertiary tracking-[0.3em] text-xs uppercase mb-3 font-bold">SPECIFICATIONS</p>
            <h2 class="font-headline text-3xl md:text-5xl font-bold tracking-tight text-on-background">Thông số kỹ thuật</h2>
        </div>

        <div class="bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/10">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-container-high">
                        <th colspan="2" class="px-8 py-5 text-left font-headline text-lg font-bold text-on-background">{{ $product->name }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    <tr class="bg-surface-container-low/50">
                        <td colspan="2" class="px-8 py-4 font-headline text-sm font-bold text-tertiary uppercase tracking-widest">Tổng quan</td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-4 font-label text-on-surface-variant w-1/3">Tên sản phẩm</td>
                        <td class="px-8 py-4 font-body text-on-background font-medium">{{ $product->name }}</td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-4 font-label text-on-surface-variant">Danh mục</td>
                        <td class="px-8 py-4 font-body text-on-background font-medium">{{ $product->category->name ?? '' }}</td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-4 font-label text-on-surface-variant">Giá bán lẻ đề xuất</td>
                        <td class="px-8 py-4 font-headline text-primary font-bold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-4 font-label text-on-surface-variant">Tình trạng</td>
                        <td class="px-8 py-4">
                            @if($product->quantity > 0)
                            <span class="inline-flex items-center gap-1.5 bg-tertiary/10 text-tertiary px-3 py-1 rounded-full text-sm font-bold">
                                <span class="w-2 h-2 bg-tertiary rounded-full"></span> Còn hàng ({{ $product->quantity }})
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 bg-error/10 text-error px-3 py-1 rounded-full text-sm font-bold">
                                <span class="w-2 h-2 bg-error rounded-full"></span> Hết hàng
                            </span>
                            @endif
                        </td>
                    </tr>

                    <tr class="bg-surface-container-low/50">
                        <td colspan="2" class="px-8 py-4 font-headline text-sm font-bold text-tertiary uppercase tracking-widest">Mô tả chi tiết</td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td colspan="2" class="px-8 py-6 font-body text-on-surface-variant leading-relaxed">{{ $product->description }}</td>
                    </tr>

                    <tr class="bg-surface-container-low/50">
                        <td colspan="2" class="px-8 py-4 font-headline text-sm font-bold text-tertiary uppercase tracking-widest">Thống kê</td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-4 font-label text-on-surface-variant">Lượt xem</td>
                        <td class="px-8 py-4 font-body text-on-background font-medium">{{ number_format($product->view) }} lượt</td>
                    </tr>
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-4 font-label text-on-surface-variant">Ngày đăng</td>
                        <td class="px-8 py-4 font-body text-on-background font-medium">{{ $product->created_at->format('d/m/Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-center gap-4">
            <button onclick="window.print()" class="flex items-center gap-2 px-6 py-3 border border-outline-variant/20 rounded-lg font-headline text-sm text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-all">
                <span class="material-symbols-outlined text-lg">download</span> Tải thông số
            </button>
        </div>
    </div>
</section>

{{-- 6. THƯ VIỆN ẢNH --}}
<section id="section-gallery" class="bg-surface-container-lowest py-20 md:py-28">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8">
        <div class="text-center mb-16">
            <p class="font-label text-tertiary tracking-[0.3em] text-xs uppercase mb-3 font-bold">GALLERY</p>
            <h2 class="font-headline text-3xl md:text-5xl font-bold tracking-tight text-on-background">Thư viện hình ảnh</h2>
            <p class="font-body text-on-surface-variant mt-3">{{ $product->images->count() }} hình ảnh</p>
        </div>

        @php
            $galleryImages = $product->images->count() > 0
                ? $product->images->pluck('image_url')->toArray()
                : [$product->image];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3">
            {{-- Ảnh lớn (2x2) --}}
            <div class="col-span-2 row-span-2 rounded-xl overflow-hidden group cursor-pointer relative">
                <img alt="{{ $product->name }} - Ảnh 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ $galleryImages[0] ?? $product->image }}"/>
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">zoom_in</span>
                </div>
            </div>

            {{-- Ảnh nhỏ (4 ô) --}}
            @for($i = 1; $i < 5; $i++)
                @if(isset($galleryImages[$i]))
                <div class="rounded-xl overflow-hidden group cursor-pointer relative aspect-square">
                    <img alt="{{ $product->name }} - Ảnh {{ $i + 1 }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 {{ $i == 1 ? 'object-left' : ($i == 3 ? 'object-right' : '') }}" src="{{ $galleryImages[$i] }}"/>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity">zoom_in</span>
                    </div>
                </div>
                @else
                <div class="rounded-xl overflow-hidden group cursor-pointer relative aspect-square bg-surface-container-high flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-surface-variant/30 text-4xl">image</span>
                </div>
                @endif
            @endfor
        </div>

        {{-- Thumbnail strip (nếu có nhiều ảnh) --}}
        @if($product->images->count() > 5)
        <div class="mt-4 flex gap-2 overflow-x-auto scrollbar-hide pb-2">
            @foreach($product->images->skip(5) as $extraImage)
            <div class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden cursor-pointer border-2 border-transparent hover:border-primary transition-colors">
                <img alt="{{ $extraImage->alt_text ?? $product->name }}" class="w-full h-full object-cover" src="{{ $extraImage->image_url }}"/>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- 7. CTA BANNER --}}
<section class="bg-gradient-to-r from-primary-container/20 via-surface to-tertiary-container/10 py-20">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 text-center">
        <h2 class="font-headline text-3xl md:text-4xl font-bold text-on-background mb-4">Sẵn sàng sở hữu {{ $product->name }}?</h2>
        <p class="font-body text-on-surface-variant text-lg mb-10 max-w-xl mx-auto">Liên hệ ngay để được tư vấn và trải nghiệm lái thử.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if($product->quantity > 0)
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="quantity" value="1"/>
                <button type="submit" class="bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold px-10 py-4 rounded-lg hover:opacity-90 transition-all hover:shadow-[0_8px_32px_rgba(41,98,255,0.3)] flex items-center gap-3 group mx-auto">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">shopping_cart</span>
                    Đặt hàng ngay
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </form>
            @endif
            <a href="tel:18008001" class="border border-outline-variant/30 text-primary font-headline font-bold px-10 py-4 rounded-lg hover:bg-surface-container-high transition-colors flex items-center gap-3 mx-auto">
                <span class="material-symbols-outlined">call</span>
                Hotline: 1800 8001
            </a>
        </div>
    </div>
</section>

{{-- 8. SẢN PHẨM LIÊN QUAN --}}
@if($relatedProducts->count() > 0)
<section class="bg-surface py-20 md:py-28">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <p class="font-label text-tertiary tracking-[0.3em] text-xs uppercase mb-2 font-bold">RELATED</p>
                <h2 class="font-headline text-3xl md:text-4xl font-bold text-on-background tracking-tight">Sản phẩm liên quan</h2>
            </div>
            <a href="{{ route('category.show', $product->category_id) }}" class="hidden md:flex items-center gap-2 text-primary font-headline text-sm font-medium hover:underline">
                Xem tất cả <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedProducts as $related)
            <a class="group flex flex-col bg-surface-container-low hover:bg-surface-container transition-all duration-300 rounded-xl overflow-hidden border border-outline-variant/5 hover:border-outline-variant/15 hover:shadow-[0_24px_48px_rgba(0,0,0,0.2)]" href="{{ route('product.show', $related->slug) }}">
                <div class="aspect-[16/10] bg-surface-container-high overflow-hidden relative">
                    <img alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ $related->image ?: '' }}"/>
                    <div class="absolute bottom-4 right-4 bg-background/80 backdrop-blur-sm px-3 py-1 rounded-lg">
                        <span class="font-headline text-primary text-sm font-bold">{{ number_format($related->price, 0, ',', '.') }} VNĐ</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="font-label text-tertiary text-xs uppercase tracking-widest mb-2 font-bold">{{ $related->category->name ?? '' }}</p>
                    <h4 class="font-headline text-xl font-bold text-on-background group-hover:text-primary transition-colors">{{ $related->name }}</h4>
                    <p class="font-body text-sm text-on-surface-variant mt-2 line-clamp-2">{{ $related->description }}</p>
                    <div class="mt-4 pt-4 border-t border-outline-variant/10 flex items-center justify-between">
                        <span class="text-primary font-headline text-sm font-medium flex items-center gap-1 group-hover:gap-2 transition-all">
                            Xem chi tiết <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sticky tab active state on scroll
    const sections = document.querySelectorAll('section[id]');
    const tabLinks = document.querySelectorAll('.tab-link');

    function setActiveTab() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 200;
            if (window.scrollY >= sectionTop) {
                current = section.getAttribute('id');
            }
        });
        tabLinks.forEach(link => {
            link.classList.remove('text-primary', 'border-primary');
            link.classList.add('text-on-surface-variant', 'border-transparent');
            if (link.getAttribute('data-section') === current) {
                link.classList.add('text-primary', 'border-primary');
                link.classList.remove('text-on-surface-variant', 'border-transparent');
            }
        });
    }

    window.addEventListener('scroll', setActiveTab);
    setActiveTab();

    // Smooth scroll for tab links
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-section');
            const target = document.getElementById(targetId);
            if (target) {
                const offset = 140;
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    // Color swatch interaction
    const swatches = document.querySelectorAll('.color-swatch');
    const colorName = document.getElementById('color-name');
    const colorNames = ['Đen Huyền Bí', 'Trắng Ngọc Trai', 'Đỏ Rực Rỡ', 'Xám Thép', 'Xanh Dương'];

    swatches.forEach((swatch, index) => {
        swatch.addEventListener('click', function() {
            swatches.forEach(s => {
                s.classList.remove('ring-primary');
                s.classList.add('ring-transparent');
            });
            this.classList.remove('ring-transparent');
            this.classList.add('ring-primary');
            colorName.textContent = colorNames[index] || this.title;
        });
    });
});
</script>
@endpush

@push('styles')
<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>
@endpush
@endsection
