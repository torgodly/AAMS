<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Http\Requests\StoreattendanceRequest;
use App\Http\Requests\UpdateattendanceRequest;
use Database\Seeders\AttendanceSeeder;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $attendanceCounts = DB::table('attendances')
            ->select('date', DB::raw('COUNT(CASE WHEN is_present = true THEN 1 ELSE null END) AS attendance'))
            ->join('users', 'attendances.student_id', '=', 'users.id')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->where('groups.teacher_id', '=', Auth::id())
            ->groupBy('date')
            ->orderByDesc('date')
            ->paginate(10);


        return view('attendance.index', ['attendances' => $attendanceCounts]);
    }

    /**
     * Edit the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //get the last added attendance date
        $lastAttendance = DB::table('attendances')
            ->select('date')
            ->orderByDesc('date')
            ->first();
        $students = Auth::user()->group?->students;

        //if there is no attendance in the database, set the date to today
        if ($lastAttendance == null) {
            $date = date('Y-m-d');
            foreach ($students as $student) {
                $attendance = new attendance();
                $attendance->student_id = $student->id;
                $attendance->date = $date;
                $attendance->is_present = false;
                $attendance->save();
            }

        } else {
            //if there is an attendance in the database, set the date to the next day "skip the weekend friday and saturday"
            $date = date('Y-m-d', strtotime($lastAttendance->date . ' +1 day'));
            if (date('l', strtotime($date)) == 'Friday') {
                $date = date('Y-m-d', strtotime($date . ' +2 day'));
            }
            if (date('l', strtotime($date)) == 'Saturday') {
                $date = date('Y-m-d', strtotime($date . ' +1 day'));
            }

            foreach ($students as $student) {
                $attendance = new attendance();
                $attendance->student_id = $student->id;
                $attendance->date = $date;
                $attendance->is_present = false;
                $attendance->save();
            }
        }

        return back()->with('success', 'Attendance added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(attendance $attendance)
    {
    }

    /**
     * Edit the form for editing the specified resource.
     */
    public function edit(attendance $attendance)
    {
        return view('attendance.edit', ['date' => $attendance->date]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateattendanceRequest $request, attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(attendance $attendance)
    {
        //
    }
}
