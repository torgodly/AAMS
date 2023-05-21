<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class Student extends User
{
    use HasParent;

    //student belong to group
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    //student has many attendances
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    //has many monthly reports
    public function monthlyReports()
    {
        return $this->hasMany(MonthlyReport::class, 'student_id');
    }

    public function getWeeklyScorese($startDate, $endDate)
{
    $monthlyReports = $this->monthlyReports()->where('start_date', $startDate)->get();
    
    $scores = [
        'name' => $this->name,
        'commitment' => 0,
        'ethics' => 0,
        'exam' => 0,
        'attendance' => 0,
        'units' => 0,
        'total' => 0
    ];
    
    foreach ($monthlyReports as $monthlyReport) {
        $weeklyReports = $monthlyReport->weeklyReports()->where('end_date', $endDate)->get();
        
        foreach ($weeklyReports as $weeklyReport) {
            $attendanceScore = $this->attendances()->whereBetween('date', [$weeklyReport->start_date, $weeklyReport->end_date])->where('is_present', true)->count() * 4;
            
            $scores['commitment'] += $weeklyReport->commitment;
            $scores['ethics'] += $weeklyReport->ethics;
            $scores['exam'] += $weeklyReport->exam;
            $scores['attendance'] += $attendanceScore;
            $scores['units'] += $weeklyReport->units;
            $scores['total'] += $weeklyReport->exam + $attendanceScore + $weeklyReport->ethics + $weeklyReport->commitment;
        }
    }
    
    return $scores;
}

}
