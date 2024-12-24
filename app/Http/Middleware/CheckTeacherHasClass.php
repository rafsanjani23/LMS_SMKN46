<?php

namespace App\Http\Middleware;

use App\Models\Classroom;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTeacherHasClass
{
   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return \Symfony\Component\HttpFoundation\Response
    */
   public function handle(Request $request, Closure $next): Response
   {
      $teacherId = Auth::user()->teacher->id;

      $teacherHasClass = Classroom::where("teacher_id", $teacherId)->exists();

      if (!$teacherHasClass) {
         // Mengirim pesan flash jika teacher tidak memiliki kelas
         session()->flash("has.no.class", "You need to create a class first!");
         return redirect()->back();
      }

      return $next($request);
   }
}
