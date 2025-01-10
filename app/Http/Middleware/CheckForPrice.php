<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckForPrice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        if($request->url('products/checkout') OR $request->url('products/pay') OR $request->url('products/success')) {
//            if(Session::get('price') == 0) {
//                return abort('403');
//            }
//        }
        if ($request->is('products/checkout', 'products/pay', 'products/success')) {
            // Verify if the price is set and not 0
            if (!Session::has('price') || Session::get('price') == 0) {
                abort(403, 'Access denied: price is not valid.');
            }
        }
        return $next($request);
    }
}
