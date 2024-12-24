<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
   protected $guarded = ["id"];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function classroom()
   {
      return $this->belongsTo(Classroom::class);
   }

   public function material()
   {
      return $this->belongsTo(Material::class);
   }

   public function statusSubmission()
   {
      if ($this->score == null && $this->file_path) {
         return "Turned In";
      } elseif ($this->score) {
         return "Graded";
      } elseif ($this->score == null && $this->file_name == null) {
         return "Assigned";
      }
   }
}
