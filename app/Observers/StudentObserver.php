<?php

namespace App\Observers;

use App\Models\Student;

class StudentObserver
{
    public function updated(Student $student)
    {
        if ($student->user) {
            $student->user->fullname = $student->fullname;
            $student->user->save();
        }
    }

    public function created(Student $student)
    {
        if ($student->user) {
            $student->user->fullname = $student->fullname;
            $student->user->save();
        }
    }
}
