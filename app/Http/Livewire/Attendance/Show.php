<?php

namespace App\Http\Livewire\Attendance;

use App\Models\attendance;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public $date;



    public function render()
    {
        // Retrieve the authenticated user's group ID
        $groupId = Auth::user()->group->id;

        // Retrieve the attendance data for the specified date within the group
        $Students = DB::table('attendances')
            ->select('users.name AS name', 'users.id AS id', 'attendances.date', 'attendances.is_present')
            ->join('users', 'attendances.student_id', '=', 'users.id')
            ->where('users.group_id', $groupId)
            ->where('attendances.date', $this->date)
            ->get();
        return view('livewire.attendance.show', ['students' => $Students]);
    }

    public function toggleAttendance($studentId, $date)
    {
        $student = Student::find($studentId);
        if ($student->group_id = auth()->user()->group->id){
            $student->attendances()->updateOrCreate(
                ['date' => $date],
                ['is_present' => DB::raw('NOT is_present')]
            );
        }
    }
}
