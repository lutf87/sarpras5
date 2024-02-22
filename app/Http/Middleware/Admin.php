<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         // Membaca role dari session
         $userRole = session('user_role');

         if ($userRole == 'admin') {
             return $next($request);
         } else {
             return response()->json(['error' => 'Anda Dilarang Mengakses Halaman Ini'], 404);
         }
         return $next($request);
    }
}
