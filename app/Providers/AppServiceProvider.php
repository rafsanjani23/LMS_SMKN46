<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Student;
use App\Observers\StudentObserver;
use App\Models\Teacher;
use App\Observers\TeacherObserver;

class AppServiceProvider extends ServiceProvider
{
   /**
    * Register any application services.
    */
   public function register(): void
   {
      //
   }

   /**
    * Bootstrap any application services.
    */
   public function boot(): void
   {
      Gate::define("student", function (User $user) {
         return $user->role === "student";
      });
      Gate::define("teacher", function (User $user) {
         return $user->role === "teacher";
      });
      Student::observe(StudentObserver::class);
      Teacher::observe(TeacherObserver::class);
   }
}
