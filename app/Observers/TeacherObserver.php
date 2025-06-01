<?php

namespace App\Observers;

use App\Models\Teacher;

class TeacherObserver
{
    public function updated(Teacher $teacher)
    {
        if ($teacher->user) {
            $teacher->user->fullname = $teacher->fullname;
            $teacher->user->save();
        }
    }

    public function created(Teacher $teacher)
    {
        if ($teacher->user) {
            $teacher->user->fullname = $teacher->fullname;
            $teacher->user->save();
        }
    }
}
