<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WebController extends Controller
{
   public function resetPassword()
   {
      return view("request-reset-password");
   }

   public function processResetPassword(Request $request)
   {
      $request->validate([
         "email" => "required",
      ]);

      $user = User::where("email", $request->email)->first();

      if (!$user) {
         return "Alamat Email Tidak Terdaftar";
      }

      $tokenBefore = DB::table("password_reset_tokens")
         ->where("email", $user->email)
         ->first();

      if ($tokenBefore) {
         $tokenTime = \Carbon\Carbon::parse($tokenBefore->created_at);
         if ($tokenTime->diffInMinutes(now()) < 0) {
            return view("sudah-send-reset-password");
         }

         DB::table("password_reset_tokens")
            ->where("email", $user->email)
            ->delete();
      }

      $token = $user->createToken("password_reset")->plainTextToken;

      DB::table("password_reset_tokens")->insert([
         "email" => $user->email,
         "token" => $token,
         "created_at" => now(),
      ]);

      $user->sendPasswordResetNotification($token);

      return view("generate-baru-reset-password");
   }

   public function changeResetPassword(Request $request)
   {
      $token = $request->token;

      if (!$token) {
         return redirect("/login");
      }

      $activeToken = DB::table("password_reset_tokens")->where("token", $token)->first();

      if (!$activeToken) {
         return redirect("/login");
      }

      return view("change-reset-password", [
         "token" => $token,
         "email" => $activeToken->email,
      ]);
   }

   public function changeProcessResetPassword(Request $request)
   {
      $request->validate([
         "token" => "required",
         "password" => "required",
      ]);

      $activeToken = DB::table("password_reset_tokens")
         ->where("token", $request->token)
         ->first();

      if (!$activeToken) {
         return redirect("/login");
      }

      $user = User::where("email", $activeToken->email)->first();

      $user->update([
         "password" => bcrypt($request->password),
      ]);

      DB::table("password_reset_tokens")
         ->where("token", $request->token)
         ->delete();

      return view("password-berhasil-diubah");
   }
}
