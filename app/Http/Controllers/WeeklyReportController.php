<?php

namespace App\Http\Controllers;

use App\Models\WeeklyReport;
use App\Models\MonthlyReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreWeeklyReportRequest;
use App\Http\Requests\UpdateWeeklyReportRequest;

// use App\Http\Controllers\MonthlyReport;

class WeeklyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('weeklyReports.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWeeklyReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($monthlyReport, $weeklyReport)
    {

        $students = Auth::user()->group->students;

        $totals = [];
        
        foreach ($students as $student) {
            $scores = $student->getWeeklyScorese($monthlyReport, $weeklyReport);
            $totals[$student->id] = $scores;
        }

        $scoreObjects = array_map(function ($scores) {
            return (object) $scores;
        }, $totals);

        return view('weeklyReports.show', ['scores' => $scoreObjects]);

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($monthlyReport, $weeklyReport)
    {
        return view('weeklyReports.edit', ['start_date' => $monthlyReport, 'end_date' => $weeklyReport]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeeklyReportRequest $request, WeeklyReport $weeklyReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeeklyReport $weeklyReport)
    {
        //
    }
}
