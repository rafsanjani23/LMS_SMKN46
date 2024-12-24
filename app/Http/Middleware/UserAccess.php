<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle($request, Closure $next, $role)
   {
      // Cek apakah user sudah login
      if (!Auth::check()) {
         return redirect("/login"); // Jika belum login, arahkan ke halaman login
      }

      // Dapatkan user yang sedang login
      $user = Auth::user();

      // Cek apakah role user sesuai dengan role yang diizinkan
      if ($user->role !== $role) {
         return redirect("/unauthorized"); // Atau bisa dialihkan ke halaman 403
      }

      return $next($request);
   }
   // public function handle(Request $request, Closure $next, $role): Response
   // {
   //     if (!Auth::user()->role == $role){
   //         return $next($request);
   //     }
   //     return response()->json(['Anda tidak di izinkan masuk ke halaman ini']);
   // }
}
