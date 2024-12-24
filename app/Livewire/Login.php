<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use illuminate\Http\Request;

class Login extends Component //atribut untuk mengarahkan main file ke auth.blade.php
   //atribut untuk title login
{
   #[Layout("components.layouts.auth")]
   #[Title("Login")]
   public $email;
   public $password;
   public function render()
   {
      return view("livewire.login");
   }

   public function login(Request $request)
   {
      $request->validate(
         [
            "email" => "required",
            "password" => "required",
         ],
         [
            "email.required" => "Email harus diisi",
            "password.required" => "Password harus diisi",
         ]
      );

      $infologin = [
         "email" => $request->email,
         "password" => $request->password,
      ];
      if (Auth::attempt($infologin)) {
         echo "sukses";
         exit();
      } else {
         return redirect("");
      }
   }

   // public function login(){
   //     // dd($this->all());
   //     // if(Auth::attempt([
   //     //     'email' => $this->email,
   //     //     'password' => $this->password
   //     // ])){
   //     //     return $this->redirect('/test',navigate:true);
   //     // }
   //     // return $this->redirect('/login', navigate:true);

   // }
}
