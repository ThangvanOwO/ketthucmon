<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        return view('checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        if (!Auth::check()) {
            return redirect()->route('auth')->with('error', 'Vui lòng đăng nhập để đặt hàng!');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:cod,bank_transfer',
            'note' => 'nullable|string|max:1000',
        ], [
            'customer_name.required' => 'Vui lòng nhập họ tên.',
            'customer_name.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'address.required' => 'Vui lòng nhập địa chỉ giao hàng.',
            'address.max' => 'Địa chỉ không được vượt quá 500 ký tự.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment_method.in' => 'Phương thức thanh toán không hợp lệ.',
        ]);

        $order = Order::create([
            'code' => 'ORD-' . strtoupper(Str::random(8)),
            'status' => 'pending',
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
        ]);

        foreach ($cart as $productId => $item) {
            OrderDetail::create([
                'product_id' => $productId,
                'order_id' => $order->id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('order.show', $order->id)->with('success', 'Đặt hàng thành công! Mã đơn: ' . $order->code);
    }
}
