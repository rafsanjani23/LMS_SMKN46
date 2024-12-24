<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
   protected $guarded = ["id"];

   public function classroom()
   {
      return $this->belongsTo(Classroom::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }
}
