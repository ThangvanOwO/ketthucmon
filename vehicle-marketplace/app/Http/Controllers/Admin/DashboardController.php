<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'categories' => Category::count(),
            'revenue' => Order::where('status', 'completed')
                ->with('orderDetails')
                ->get()
                ->sum(fn($o) => $o->orderDetails->sum(fn($d) => $d->quantity * $d->price)),
            'pendingOrders' => Order::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with(['user', 'orderDetails.product'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $topProducts = Product::orderBy('view', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts'));
    }
}
