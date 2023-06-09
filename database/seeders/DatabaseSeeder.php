<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attendance;
use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'الشيخ عبدالله',
            'email' => 'admin@admin.com',
            'type' => 'admin',
            'password' => bcrypt('quranmausem@123')
        ]);
//
//        \App\Models\User::factory(10)->create(['type' => 'Teacher']);
//        \App\Models\User::factory(2)->create(['type' => 'Student', 'group_id' => 1]);
//        Group::factory()->create(['teacher_id' => 2]);
//        $teachers = Teacher::all();
//        foreach ($teachers as $teacher) {
//            Group::factory()->create(['teacher_id' => $teacher->id]);
//        }


        //create students and attach every 10 students to a group
//        $students = Student::all();
//        $groups = Group::all();
//        $i = 0;
//        foreach ($students as $student) {
//            $student->update(['group_id' => $groups[$i]->id]);
//            if ($i == 9) {
//                $i = 0;
//            } else {
//                $i++;
//            }
//        }


    }
}
