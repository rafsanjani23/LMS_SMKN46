<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
   protected $guarded = ["id"];

   public function classroom()
   {
      return $this->belongsTo(Classroom::class);
   }

   public function submissions()
   {
      return $this->hasMany(Submission::class);
   }
}
