<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('auth')->with('error', 'Vui lòng đăng nhập!');
        }

        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('auth')->with('error', 'Bạn không có quyền truy cập trang quản trị!');
        }

        return $next($request);
    }
}
