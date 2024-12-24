<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class defaultUsers extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      DB::table("users")->insert([
         [
            "username" => "admin",
            "email" => "admin@lms.com",
            "password" => bcrypt("password"),
            "role" => "admin",
         ],
         [
            "username" => "guru",
            "email" => "guru@lms.com",
            "password" => bcrypt("password"),
            "role" => "guru",
         ],
         [
            "username" => "siswa",
            "email" => "siswa@lms.com",
            "password" => bcrypt("password"),
            "role" => "user",
         ],
      ]);
   }
}
