@extends('layouts.app')
@section('title', 'Thanh toán | KINETIC')

@section('content')
<div class="w-full max-w-[1440px] mx-auto px-4 md:px-8 py-12 md:py-24">
    <div class="mb-16">
        <h1 class="font-headline text-4xl md:text-5xl font-bold tracking-tighter text-on-surface mb-2">Thanh toán an toàn</h1>
        <p class="text-on-surface-variant font-body text-sm md:text-base flex items-center gap-2">
            <span class="material-symbols-outlined text-tertiary text-sm">lock</span>
            Giao dịch mã hóa đầu cuối
        </p>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
    <div class="mb-8 p-4 bg-error-container/20 text-error rounded-lg font-body text-sm max-w-[1440px]">
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-lg mt-0.5">error</span>
            <div>
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">
            {{-- Left: Customer Info Form --}}
            <div class="lg:col-span-7 flex flex-col gap-12">
                {{-- Section 1: Personal Info --}}
                <section class="bg-surface-container-lowest p-8 md:p-10 rounded-xl border border-outline-variant/10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-xl">person</span>
                        </div>
                        <div>
                            <h2 class="font-headline text-xl font-bold text-on-surface">Thông tin cá nhân</h2>
                            <p class="font-body text-sm text-on-surface-variant">Nhập thông tin để giao hàng</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Full Name --}}
                        <div>
                            <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider mb-2" for="customer_name">Họ và tên <span class="text-error">*</span></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-xl">person</span>
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', auth()->user()?->email ?? '') }}" placeholder="Nguyễn Văn A" required
                                    class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-4 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all font-body text-sm {{ $errors->has('customer_name') ? 'border-error' : '' }}"/>
                            </div>
                            @error('customer_name') <p class="text-error text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider mb-2" for="phone">Số điện thoại <span class="text-error">*</span></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-xl">phone</span>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="0912 345 678" required
                                    class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-4 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all font-body text-sm {{ $errors->has('phone') ? 'border-error' : '' }}"/>
                            </div>
                            @error('phone') <p class="text-error text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider mb-2" for="email">Email <span class="text-error">*</span></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-xl">mail</span>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()?->email ?? '') }}" placeholder="email@example.com" required
                                    class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-4 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all font-body text-sm {{ $errors->has('email') ? 'border-error' : '' }}"/>
                            </div>
                            @error('email') <p class="text-error text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        {{-- Address --}}
                        <div>
                            <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider mb-2" for="address">Địa chỉ giao hàng <span class="text-error">*</span></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-4 text-on-surface-variant/50 text-xl">location_on</span>
                                <textarea id="address" name="address" rows="3" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố" required
                                    class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl pl-12 pr-4 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all font-body text-sm resize-none {{ $errors->has('address') ? 'border-error' : '' }}">{{ old('address') }}</textarea>
                            </div>
                            @error('address') <p class="text-error text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        {{-- Note --}}
                        <div>
                            <label class="block font-label text-xs font-semibold text-on-surface-variant uppercase tracking-wider mb-2" for="note">Ghi chú (tùy chọn)</label>
                            <textarea id="note" name="note" rows="2" placeholder="Ghi chú cho đơn hàng..."
                                class="w-full bg-surface-container-highest border border-outline-variant/15 rounded-xl px-4 py-3.5 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all font-body text-sm resize-none">{{ old('note') }}</textarea>
                        </div>
                    </div>
                </section>

                {{-- Section 2: Payment Method --}}
                <section class="bg-surface-container-lowest p-8 md:p-10 rounded-xl border border-outline-variant/10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-lg bg-tertiary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-tertiary text-xl">payments</span>
                        </div>
                        <div>
                            <h2 class="font-headline text-xl font-bold text-on-surface">Phương thức thanh toán</h2>
                            <p class="font-body text-sm text-on-surface-variant">Chọn cách thanh toán phù hợp</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        {{-- COD --}}
                        <label class="flex items-start gap-4 p-5 bg-surface-container-high rounded-xl cursor-pointer border-2 {{ old('payment_method', 'cod') === 'cod' ? 'border-primary' : 'border-transparent' }} hover:border-primary/50 transition-all group" id="label-cod">
                            <input type="radio" name="payment_method" value="cod" {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}
                                class="mt-1 w-5 h-5 text-primary bg-surface-container-highest border-outline-variant focus:ring-primary focus:ring-offset-background"
                                onchange="updatePaymentStyle()"/>
                            <div class="flex-grow">
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="material-symbols-outlined text-primary text-2xl">local_shipping</span>
                                    <span class="font-headline font-bold text-on-surface">Thanh toán khi nhận hàng (COD)</span>
                                </div>
                                <p class="font-body text-sm text-on-surface-variant ml-11">Thanh toán bằng tiền mặt khi nhận được hàng. Miễn phí vận chuyển.</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center gap-1.5 bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold">
                                    <span class="w-2 h-2 bg-primary rounded-full"></span> Phổ biến
                                </span>
                            </div>
                        </label>

                        {{-- Bank Transfer --}}
                        <label class="flex items-start gap-4 p-5 bg-surface-container-high rounded-xl cursor-pointer border-2 {{ old('payment_method') === 'bank_transfer' ? 'border-primary' : 'border-transparent' }} hover:border-primary/50 transition-all group" id="label-bank_transfer">
                            <input type="radio" name="payment_method" value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }}
                                class="mt-1 w-5 h-5 text-primary bg-surface-container-highest border-outline-variant focus:ring-primary focus:ring-offset-background"
                                onchange="updatePaymentStyle()"/>
                            <div class="flex-grow">
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="material-symbols-outlined text-tertiary text-2xl">account_balance</span>
                                    <span class="font-headline font-bold text-on-surface">Chuyển khoản ngân hàng</span>
                                </div>
                                <p class="font-body text-sm text-on-surface-variant ml-11">Chuyển khoản trước khi giao hàng. Thông tin tài khoản sẽ được gửi qua email sau khi đặt hàng.</p>
                            </div>
                        </label>
                    </div>
                    @error('payment_method') <p class="text-error text-xs mt-3">{{ $message }}</p> @enderror

                    {{-- Bank Info (shown when bank_transfer selected) --}}
                    <div id="bank-info" class="mt-6 p-5 bg-surface-container rounded-xl border border-outline-variant/10 {{ old('payment_method') === 'bank_transfer' ? '' : 'hidden' }}">
                        <h4 class="font-headline font-bold text-on-surface mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-tertiary text-lg">info</span>
                            Thông tin chuyển khoản
                        </h4>
                        <div class="space-y-2 font-body text-sm text-on-surface-variant">
                            <p><span class="text-on-surface font-semibold">Ngân hàng:</span> Vietcombank</p>
                            <p><span class="text-on-surface font-semibold">Số TK:</span> 1234567890</p>
                            <p><span class="text-on-surface font-semibold">Chủ TK:</span> CÔNG TY KINETIC VIETNAM</p>
                            <p><span class="text-on-surface font-semibold">Nội dung:</span> [Mã đơn hàng] - [Họ tên]</p>
                        </div>
                    </div>
                </section>
            </div>

            {{-- Right: Order Summary --}}
            <div class="lg:col-span-5 relative">
                <div class="sticky top-32 flex flex-col gap-8">
                    <div class="bg-surface-container-low rounded-xl p-8 flex flex-col gap-8 shadow-[0_48px_100px_rgba(182,196,255,0.02)] ring-1 ring-outline-variant/15">
                        <h2 class="font-headline text-xl font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">receipt_long</span>
                            Tóm tắt đơn hàng
                        </h2>

                        <div class="flex flex-col gap-5">
                            @php $total = 0; @endphp
                            @foreach($cart as $id => $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <div class="flex gap-4 group">
                                <div class="w-20 h-14 bg-surface-container-high rounded-lg overflow-hidden flex-shrink-0">
                                    <img alt="{{ $item['name'] }}" class="w-full h-full object-cover opacity-80" src="{{ $item['image'] ?: 'https://via.placeholder.com/100x60' }}"/>
                                </div>
                                <div class="flex flex-col justify-center flex-grow min-w-0">
                                    <h4 class="font-headline text-on-surface text-sm font-bold truncate">{{ $item['name'] }}</h4>
                                    <p class="text-xs font-label text-on-surface-variant">SL: {{ $item['quantity'] }} × {{ number_format($item['price'], 0, ',', '.') }}đ</p>
                                </div>
                                <div class="font-headline text-primary text-sm font-bold flex items-center whitespace-nowrap">
                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Totals --}}
                        <div class="space-y-3 pt-4 border-t border-outline-variant/10">
                            <div class="flex justify-between text-sm font-body text-on-surface-variant">
                                <span>Tạm tính ({{ count($cart) }} sản phẩm)</span>
                                <span class="text-on-surface font-medium">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex justify-between text-sm font-body text-on-surface-variant">
                                <span>Phí vận chuyển</span>
                                <span class="text-green-400 font-semibold">Miễn phí</span>
                            </div>
                            <div class="glow-line my-2"></div>
                            <div class="flex justify-between items-end">
                                <span class="font-headline font-bold text-on-surface text-lg">Tổng cộng</span>
                                <span class="font-headline text-3xl font-bold text-primary tracking-tight">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        @auth
                        <button type="submit" class="w-full bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold tracking-tight text-lg py-5 rounded-xl hover:opacity-90 transition-opacity flex justify-center items-center gap-3 mt-4 shadow-[0_20px_40px_rgba(41,98,255,0.2)] group">
                            <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">shopping_cart_checkout</span>
                            <span>Xác nhận đặt hàng</span>
                        </button>
                        @else
                        <a href="{{ route('auth') }}" class="w-full bg-gradient-to-r from-primary-container to-primary text-on-primary font-headline font-bold tracking-tight text-lg py-5 rounded-xl hover:opacity-90 transition-opacity flex justify-center items-center gap-3 mt-4 shadow-[0_20px_40px_rgba(41,98,255,0.2)]">
                            <span class="material-symbols-outlined text-xl">login</span>
                            <span>Đăng nhập để đặt hàng</span>
                        </a>
                        @endauth

                        <div class="flex items-center justify-center gap-2 text-on-surface-variant/40">
                            <span class="material-symbols-outlined text-sm">shield</span>
                            <span class="font-label text-xs uppercase tracking-wider">Bảo mật SSL 256-bit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function updatePaymentStyle() {
    const codLabel = document.getElementById('label-cod');
    const bankLabel = document.getElementById('label-bank_transfer');
    const bankInfo = document.getElementById('bank-info');
    const codRadio = document.querySelector('input[name="payment_method"][value="cod"]');
    const bankRadio = document.querySelector('input[name="payment_method"][value="bank_transfer"]');

    if (codRadio && codRadio.checked) {
        codLabel.classList.add('border-primary');
        codLabel.classList.remove('border-transparent');
        bankLabel.classList.remove('border-primary');
        bankLabel.classList.add('border-transparent');
        bankInfo.classList.add('hidden');
    } else if (bankRadio && bankRadio.checked) {
        bankLabel.classList.add('border-primary');
        bankLabel.classList.remove('border-transparent');
        codLabel.classList.remove('border-primary');
        codLabel.classList.add('border-transparent');
        bankInfo.classList.remove('hidden');
    }
}

document.addEventListener('DOMContentLoaded', updatePaymentStyle);
</script>
@endpush
@endsection
