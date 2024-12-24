<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Material;
use App\Models\Classroom;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
   public function submitAssignment(Classroom $classroom, Material $material, Request $request)
   {
      $validatedData = $request->validate([
         "file_path" => "file|mimes:pdf,ppt,pptx,doc,docx|max:102400",
      ]);

      $studentAssignment = Submission::where("user_id", Auth::user()->id)
         ->where("material_id", $material->id)
         ->where("classroom_id", $classroom->id)
         ->first();

      if ($request->isUpdate == "update") {
         Storage::disk("public")->delete($studentAssignment->file_path);
      }

      if ($request->hasFile("file_path")) {
         $validatedData["file_path"] = $request->file("file_path")->store("student-assignment", "public");
      }

      $validatedData["classroom_id"] = $classroom->id;
      $validatedData["material_id"] = $material->id;
      $validatedData["user_id"] = Auth::user()->id;
      $validatedData["submitted_at"] = Carbon::now("Asia/Jakarta")->format("Y-m-d H:i:s");
      $validatedData["file_type"] = $request->file("file_path")->getClientOriginalExtension();
      $validatedData["file_name"] = $request->file("file_path")->getClientOriginalName();

      if ($request->isUpdate == "update") {
         $studentAssignment->update($validatedData);
      } else {
         Submission::create($validatedData);
      }

      return redirect()
         ->route("student.show.assignment", ["classroom" => $classroom, "material" => $material])
         ->with("assignment.success", "Your assignment has been successfully submitted!");
   }

   public function updateStudentScore(Material $material, Submission $submission, Request $request)
   {
      $validatedData = $request->validate([
         "score" => "required|numeric",
      ]);

      $submission->update($validatedData);

      return back();
   }
}
