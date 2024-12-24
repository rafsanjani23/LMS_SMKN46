<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Classroom;
use App\Models\Submission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
   public function showAddFile(Classroom $classroom)
   {
      return view("teacher.classroom.material.add-content", [
         "title" => "Upload Content - File PDF/PPT",
         "classroom" => $classroom,
      ]);
   }

   public function showAddVideo(Classroom $classroom)
   {
      return view("teacher.classroom.material.add-content", [
         "title" => "Upload Content - Video",
         "classroom" => $classroom,
      ]);
   }

   public function addMaterial(Request $request, Classroom $classroom)
   {
      $validatedData = $request->validate([
         "title" => "required|string|max:255",
         "description" => "nullable|string",
         "video_link" => "nullable|string",
         "file_path" => "file|mimes:pdf,ppt,pptx,mp4,mkv|max:102400",
         "deadline" => "nullable|date|after_or_equal:today",
      ]);

      $validatedData["classroom_id"] = $classroom->id;

      if (!empty($validatedData["video_link"])) {
         $validatedData["type"] = "link";
      } elseif ($request->hasFile("file_path")) {
         $validatedData["type"] = $request->file("file_path")->getClientOriginalExtension();
         $validatedData["file_path"] = $request->file("file_path")->store("materials", "public");
         $validatedData["file_name"] = $request->file("file_path")->getClientOriginalName();
      } else {
         $validatedData["type"] = null;
      }

      if (Str::contains($request->material_type, "file")) {
         $validatedData["material_type"] = "file";
      } elseif (Str::contains($request->material_type, "video")) {
         $validatedData["material_type"] = "video";
      } else {
         $validatedData["material_type"] = "assignment";
      }

      // dd($validatedData);

      Material::create($validatedData);

      session()->flash("add.material.success", "Material has been successfully added.");

      return redirect()
         ->route("show.classwork", $classroom->id)
         ->with("add.material.success", "Material has been successfully added.");
   }

   public function deleteMaterial(Classroom $classroom, Material $material)
   {
      try {
         if ($material->file_path) {
            Storage::disk("public")->delete($material->file_path);
         }

         $material->delete();
         return redirect()
            ->route("show.classwork", $material->classroom_id)
            ->with("delete.material", "Material has been successfully deleted!");
      } catch (\Exception $e) {
         return redirect()
            ->back()
            ->with("error", "Gagal menghapus kelas: " . $e->getMessage());
      }
   }

   public function showMaterialFileUpdate(Classroom $classroom, Material $material)
   {
      return view("teacher.classroom.material.update-material", [
         "title" => "Update Content - File PDF/PPT",
         "material" => $material,
         "classroom" => $classroom,
      ]);
   }

   public function showMaterialVideoUpdate(Classroom $classroom, Material $material)
   {
      return view("teacher.classroom.material.update-material", [
         "title" => "Update Content - Video",
         "material" => $material,
         "classroom" => $classroom,
      ]);
   }

   public function updateMaterial(Classroom $classroom, Material $material, Request $request)
   {
      $validatedData = $request->validate([
         "title" => "required|string|max:255",
         "description" => "nullable|string",
         "file_path" => "file|mimes:pdf,ppt,pptx,mp4,mkv|max:102400",
         "deadline" => "date",
      ]);

      if (!empty($validatedData["video_link"])) {
         $validatedData["type"] = "link";
      } elseif ($request->hasFile("file_path")) {
         if ($material->file_path) {
            Storage::disk("public")->delete($material->file_path);
         }

         $validatedData["file_path"] = $request->file("file_path")->store("materials", "public");
         $validatedData["type"] = $request->file("file_path")->getClientOriginalExtension();
         $validatedData["file_name"] = $request->file("file_path")->getClientOriginalName();
      }

      $material->update($validatedData);
      return redirect()
         ->route("show.classwork", $material->classroom_id)
         ->with("update.material.success", "Your material has been updated successfully!");
   }

   public function showMaterial(Classroom $classroom, Material $material)
   {
      return view("teacher.classroom.material.show-material", [
         "title" => "Material | $material->title",
         "material" => $material,
         "classroom" => $classroom,
      ]);
   }

   public function showAddAssignment(Classroom $classroom)
   {
      return view("teacher.classroom.material.add-content", [
         "title" => "Upload Assignment",
         "classroom" => $classroom,
      ]);
   }

   public function showAssignmentUpdate(Classroom $classroom, Material $material)
   {
      return view("teacher.classroom.material.update-material", [
         "title" => "Update Content - Assignment",
         "material" => $material,
         "classroom" => $classroom,
      ]);
   }

   public function studentMaterial(Classroom $classroom, Material $material)
   {
      return view("student.classroom.material.show-material", [
         "title" => "Material | $material->title",
         "material" => $material,
         "classroom" => $classroom,
      ]);
   }

   public function studentShowAssignment(Classroom $classroom, Material $material)
   {
      $assignment = Submission::where("user_id", Auth::user()->id)
         ->where("material_id", $material->id)
         ->where("classroom_id", $classroom->id)
         ->first();

      return view("student.classroom.material.show-assignment", [
         "title" => "Assignment | $material->title",
         "material" => $material,
         "classroom" => $classroom,
         "assignment" => $assignment,
      ]);
   }
}
