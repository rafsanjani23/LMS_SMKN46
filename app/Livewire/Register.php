<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component //atribut untuk title register
{
   #[Layout("components.layouts.auth")]
   #[Title("Register")]
   public function render()
   {
      return view("livewire.register");
   }
}
