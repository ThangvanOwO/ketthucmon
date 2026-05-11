@extends('layouts.app')
@section('title', 'Giới thiệu | KINETIC')

@section('content')
{{-- Hero --}}
<section class="relative min-h-[600px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-surface-container-high">
        <img alt="Kinetic Vehicle" class="w-full h-full object-cover opacity-60 mix-blend-luminosity" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDCoMjNUkkLIp4Q8Vno4_KVNP1CQh1rW32sV6UzNg3R7SRqNcanN8c1iW4LojErsBB1xzSJl7AYVfJXeJ9kwkdItNBShVmc93Q6igJ3WH7_zkPQe9Sb_ttD16fdDGK7S2z2CHLrME7E7ocHNhC9Yv3Cf8qk6bzF9ECcKYV17trPVbcaSEiddtqI79Y4UukTgrZXU3YG-5ZAu5FNGi_K5hCkSa3Ant3_1bXUKlHs0_l58OI6mFkHXRBQSDKkPR0dC2TKCSUhewWWR-dP"/>
        <div class="absolute inset-0 bg-gradient-to-t from-background via-background/80 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-[1440px] mx-auto px-8 w-full">
        <div class="max-w-3xl">
            <h1 class="font-headline text-5xl md:text-7xl font-bold tracking-tighter text-on-background mb-6 leading-none">
                THIẾT KẾ CHO <br/><span class="text-primary">TƯƠNG LAI</span>
            </h1>
            <p class="font-body text-xl md:text-2xl text-on-surface-variant font-light max-w-2xl leading-relaxed">
                Chúng tôi không chỉ bán xe. Chúng tôi rèn nên những kiệt tác tái định nghĩa giao điểm của sức mạnh và công nghệ bền vững.
            </p>
        </div>
    </div>
</section>

{{-- Mission --}}
<section class="py-32 bg-background">
    <div class="max-w-[1440px] mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <div class="lg:col-span-5 lg:col-start-2">
                <h2 class="font-headline text-3xl md:text-4xl font-bold text-on-background mb-8 tracking-tight">SỨ MỆNH CỦA CHÚNG TÔI</h2>
                <div class="space-y-6 font-body text-on-surface-variant text-lg leading-relaxed">
                    <p>Sinh ra từ sự theo đuổi không ngừng sự hoàn hảo khí động học, KINETIC được thành lập trên nguyên tắc: hiệu suất không bao giờ được hy sinh tiến bộ.</p>
                    <p>Mỗi khung xe, mỗi động cơ và mỗi dòng mã chúng tôi viết đều dành cho việc vượt qua ranh giới của những gì khả thi trong vận tải.</p>
                </div>
                <div class="mt-12 flex gap-4">
                    <div class="p-6 bg-surface-container-low rounded-lg w-1/2">
                        <span class="material-symbols-outlined text-tertiary text-4xl mb-4 block">speed</span>
                        <h3 class="font-headline text-xl text-on-background font-bold mb-2">CHÍNH XÁC</h3>
                        <p class="text-sm text-on-surface-variant">Được thiết kế với dung sai micromet.</p>
                    </div>
                    <div class="p-6 bg-surface-container-low rounded-lg w-1/2">
                        <span class="material-symbols-outlined text-tertiary text-4xl mb-4 block">bolt</span>
                        <h3 class="font-headline text-xl text-on-background font-bold mb-2">SỨC MẠNH</h3>
                        <p class="text-sm text-on-surface-variant">Mô-men xoắn điện tức thì, không ngừng.</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-6 relative">
                <div class="aspect-[4/5] bg-surface-container-low rounded-lg overflow-hidden relative">
                    <img alt="Engineering Detail" class="w-full h-full object-cover opacity-80" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC17cXLwz5UcQ0QDeOxQOO3yg5vC82kyUZD1_L7NzTPOdtlb6u56gRcKY0OeE55Aqt4HPZT5Zv-M6kNXff0rIvJKojBGdFLE_mxEgWLOxeBDPO0kKmh-PmJ6ShVCMGV2gtlZVKY_byeM2VNJaPRDzW9QSweXpfyPMSE1QxSrFoY0HMjI-n3uZh9UPTyHxWJ__uVTkTL63g44rz_3eyie49n-Hb1IcDIEPurjpqifi-ERSEWhE1DN6D5CgQhOqEBPHKBCg-LZg5Wu96i"/>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="py-32 bg-surface-container-lowest">
    <div class="max-w-[1440px] mx-auto px-8">
        <div class="mb-16">
            <h2 class="font-headline text-4xl font-bold text-on-background tracking-tight mb-4">GIÁ TRỊ CỐT LÕI</h2>
            <p class="font-body text-on-surface-variant max-w-2xl text-lg">Những trụ cột kiến trúc định nghĩa mỗi sản phẩm KINETIC.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[300px]">
            <div class="md:col-span-2 bg-surface-container-low rounded-xl p-10 flex flex-col justify-end relative overflow-hidden group hover:bg-surface-container transition-colors duration-300">
                <div class="relative z-10">
                    <span class="material-symbols-outlined text-tertiary text-3xl mb-4">air</span>
                    <h3 class="font-headline text-2xl font-bold text-on-background mb-2">KHÍ ĐỘNG HỌC TUYỆT ĐỐI</h3>
                    <p class="font-body text-on-surface-variant">Được điêu khắc bởi gió. Mỗi đường cong phục vụ mục đích chức năng.</p>
                </div>
            </div>
            <div class="bg-surface-container-low rounded-xl p-10 flex flex-col justify-start relative group hover:bg-surface-container transition-colors duration-300">
                <span class="material-symbols-outlined text-primary text-3xl mb-4">memory</span>
                <h3 class="font-headline text-xl font-bold text-on-background mb-2">HỆ THỐNG SỐ</h3>
                <p class="font-body text-on-surface-variant text-sm mt-auto">AI quản lý phân phối năng lượng với độ chính xác mili giây.</p>
            </div>
            <div class="bg-surface-container-low rounded-xl p-10 flex flex-col justify-start relative group hover:bg-surface-container transition-colors duration-300">
                <span class="material-symbols-outlined text-primary text-3xl mb-4">eco</span>
                <h3 class="font-headline text-xl font-bold text-on-background mb-2">KHÔNG PHÁT THẢI</h3>
                <p class="font-body text-on-surface-variant text-sm mt-auto">Sức mạnh không thỏa hiệp, không khí thải.</p>
            </div>
            <div class="md:col-span-2 bg-surface-container-low rounded-xl p-10 flex flex-col justify-center relative overflow-hidden group hover:bg-surface-container transition-colors duration-300">
                <div class="flex justify-between items-center z-10 relative">
                    <div class="max-w-md">
                        <h3 class="font-headline text-2xl font-bold text-on-background mb-2">THỦ CÔNG TINH XẢO</h3>
                        <p class="font-body text-on-surface-variant">Nội thất may tay kết hợp titanium cấp hàng không vũ trụ.</p>
                    </div>
                    <span class="material-symbols-outlined text-tertiary text-5xl hidden md:block">diamond</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
