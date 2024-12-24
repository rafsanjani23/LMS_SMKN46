<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      Schema::create("submissions", function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger("user_id");
         $table->unsignedBigInteger("material_id");
         $table->unsignedBigInteger("classroom_id");
         $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
         $table->foreign("classroom_id")->references("id")->on("classrooms")->onDelete("cascade");
         $table->foreign("material_id")->references("id")->on("materials")->onDelete("cascade");
         $table->string("file_path");
         $table->timestamp("submitted_at")->nullable();
         $table->string("file_type")->nullable();
         $table->string("file_name")->nullable();
         $table->integer("score")->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists("submissions");
   }
};
