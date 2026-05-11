<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('auth')->with('error', 'Vui lòng đăng nhập để xem đơn hàng!');
        }

        $orders = Order::where('user_id', Auth::id())
            ->with('orderDetails.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('order.index', compact('orders'));
    }

    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth')->with('error', 'Vui lòng đăng nhập để xem đơn hàng!');
        }

        $order = Order::where('user_id', Auth::id())
            ->with('orderDetails.product')
            ->findOrFail($id);

        return view('order.show', compact('order'));
    }
}
