<?php

namespace App\Http\Livewire\Attendance;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $date;
    public $memorization;
    public $editable = null; // add this line
    public $editedValues = []; // add this line

    protected function rules()
    {
        $rules = [];
        foreach ($this->editedValues as $id => $values) {
            $rules["editedValues.{$id}.memorization"] = ['numeric', 'between:0,2'];
        }
        return $rules;
    }

    public function render()
    {
        // Retrieve the authenticated user's group ID
        $groupId = Auth::user()->group->id;

        // Retrieve the attendance data for the specified date within the group
        $Students = DB::table('attendances')
            ->select('users.name AS name', 'users.id AS id', 'attendances.date', 'attendances.is_present', 'attendances.memorization', 'attendances.id AS attendance_id')
            ->join('users', 'attendances.student_id', '=', 'users.id')
            ->where('users.group_id', $groupId)
            ->where('attendances.date', $this->date)
            ->orderBy('name', 'asc')
            ->get();
//        dd($Students);
        return view('livewire.attendance.edit', ['students' => $Students]);
    }

    public function toggleAttendance($studentId, $date)
    {
        $student = Student::find($studentId);
        if ($student->group_id = auth()->user()->group->id) {
            $student->attendances()->updateOrCreate(
                ['date' => $date],
                ['is_present' => DB::raw('NOT is_present')]
            );
        }
    }

    public function makeEditable($id)
    {
        $this->editable = $id;
    }

    public function resetEditable()
    {
        $this->editable = null;
        $this->editedValues = [];
    }

    public function saveChanges()
    {
        $this->validate();
        foreach ($this->editedValues as $id => $values) {
//             dd($values);
            $attendance = Attendance::find($id);
//             dd($attendance);
            $attendance->update($values);
        }
        // dd($this->editedValues);
        $this->resetEditable();
    }
}
