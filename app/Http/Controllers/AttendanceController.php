<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Http\Requests\StoreattendanceRequest;
use App\Http\Requests\UpdateattendanceRequest;
use Database\Seeders\AttendanceSeeder;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreattendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(attendance $attendance)
    {
        return view('attendance.show', ['date' => $attendance->date]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(attendance $attendance)
    {
        //
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
