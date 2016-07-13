<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 请求后的中间件
//        $response = $next($request);
//        if (!session('user')) {
//            return redirect()->route('admin.login');
//        }
//        return $response;
        
        // 请求前的中间件
        if (!session('user')) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
