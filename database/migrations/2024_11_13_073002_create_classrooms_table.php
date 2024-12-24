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
      Schema::create("classrooms", function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger("teacher_id");
         $table->foreign("teacher_id")->references("id")->on("teachers")->onDelete("cascade");
         $table->string("title");
         $table->enum("major", ["pplg", "dkv", "akl", "otkp", "bdp"]);
         $table->enum("class", ["x", "xi", "xii"]);
         $table->string("thumbnail_class");
         $table->text("instructions")->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists("classrooms");
   }
};
