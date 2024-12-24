<?php

use App\Http\Middleware\CheckProfileCompletion;
use App\Http\Middleware\CheckTeacherHasClass;
use App\Http\Middleware\ForceUserAccess;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
   ->withRouting(web: __DIR__ . "/../routes/web.php", api: __DIR__ . "/../routes/api.php", commands: __DIR__ . "/../routes/console.php", health: "/up")
   ->withMiddleware(function (Middleware $middleware) {
      $middleware->alias([
         "check.profile.data" => CheckProfileCompletion::class,
         "check.teacher.class" => CheckTeacherHasClass::class,
         "force.user" => ForceUserAccess::class,
      ]);
   })
   ->withExceptions(function (Exceptions $exceptions) {
      //
   })
   ->create();
