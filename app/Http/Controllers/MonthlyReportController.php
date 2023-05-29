<?php

namespace App\Http\Controllers;

use App\Models\MonthlyReport;
use App\Http\Requests\StoreMonthlyReportRequest;
use App\Http\Requests\UpdateMonthlyReportRequest;
use App\Models\Result;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonthlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monthlyReports = DB::table('monthly_reports')
            ->select('monthly_reports.start_date','monthly_reports.end_date',  )
            ->join('users', 'monthly_reports.student_id', '=', 'users.id')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->where('groups.teacher_id', '=', Auth::id())
            ->groupBy('start_date', 'end_date', )
            ->orderByDesc('start_date')
            ->paginate(10);
//        dd($monthlyReports);
        return view('reports.index', compact('monthlyReports'));
    }

    /**
     * Edit the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
       //check if there is a monthly report recrord and get the end date and create a new reocrd with the start of the month after the end date as start_date and the end of it as end date
        $lastMonthlyReport = DB::table('monthly_reports')
            ->select('end_date', 'start_date')
            ->orderByDesc('end_date')
            ->first();
        $students = Auth::user()->group?->students;

        //if there is no monthly report in the database, set the date to today
        if ($lastMonthlyReport == null) {
            $start_date = Carbon::create(2023, 6, 3)->format('Y-m-d');
            $end_date = Carbon::parse($start_date)->addWeeks(4)->subDay()->format('Y-m-d');
            foreach ($students as $student) {
                $monthlyReport = new MonthlyReport();
                $monthlyReport->student_id = $student->id;
                $monthlyReport->start_date = $start_date;
                $monthlyReport->end_date = $end_date;
                $monthlyReport->save();
            }
        } else {
            $start_date = Carbon::parse($lastMonthlyReport->end_date)->copy()->addDay()->format('Y-m-d');
            $end_date = Carbon::parse($start_date)->copy()->addWeeks(4)->subDay()->format('Y-m-d');
            foreach ($students as $student) {
                $monthlyReport = new MonthlyReport();
                $monthlyReport->student_id = $student->id;
                $monthlyReport->start_date = $start_date;
                $monthlyReport->end_date = $end_date;
                $monthlyReport->save();
            }
        }
        return redirect()->route('reports.index');

    }

    /**
     * Display the specified resource.
     */
    public
    function show(MonthlyReport $Report)
    {
        $score =Result::getMonthlyScores($Report->start_date, $Report->end_date);
        return view('reports.show', ['scores' => $score, 'monthlyReport' => $Report]);

    }

    /**
     * Edit the form for editing the specified resource.
     */
    public
    function edit(MonthlyReport $Report)
    {
//        dd($Report->start_date);
        return view('reports.edit', ['start_date' => $Report->start_date]);
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(UpdateMonthlyReportRequest $request, MonthlyReport $monthlyReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(MonthlyReport $monthlyReport)
    {
        //
    }
}
