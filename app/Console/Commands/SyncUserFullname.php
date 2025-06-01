<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;

class SyncUserFullname extends Command
{
    protected $signature = 'users:sync-fullname';
    protected $description = 'Sync fullname from students and teachers to users table';

    public function handle()
    {
        // Student
        $students = Student::with('user')->get();
        foreach ($students as $student) {
            if ($student->user) {
                $student->user->fullname = $student->fullname;
                $student->user->save();
            }
        }

        // Teacher
        $teachers = Teacher::with('user')->get();
        foreach ($teachers as $teacher) {
            if ($teacher->user) {
                $teacher->user->fullname = $teacher->fullname;
                $teacher->user->save();
            }
        }

        // Admin
        User::where('role', 'admin')
            ->update(['fullname' => 'Kepala Sekolah']);

        $this->info('Fullname synced successfully.');
    }
}
