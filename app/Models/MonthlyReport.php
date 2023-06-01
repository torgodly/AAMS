<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyReport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
        'fiqh',
        'khata',
        'ahkam',
        'student_id',
    ];

    //monthly report belongs to student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function weeklyReports()
    {
        return $this->hasMany(WeeklyReport::class, 'monthly_report_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($monthlyReport) {
            $startDate = Carbon::parse($monthlyReport->start_date);
            $endDate = Carbon::parse($monthlyReport->end_date);

            // Calculate the start and end dates for each week in the month
            $weeks = [];
            $curWeekStart = $startDate;
            while ($curWeekStart->lte($endDate)) {
                // Check if the current day is not Saturday
                if (!$curWeekStart->isSaturday()) {
                    // Skip this week
                    $curWeekStart->next(Carbon::SATURDAY);
                    continue;
                }

                $curWeekEnd = $curWeekStart->copy()->addDays(4)->setTime(23, 59, 59);
                if ($curWeekEnd->gt($endDate)) {
                    $curWeekEnd = $endDate;
                }
                $weeks[] = [
                    'start_date' => $curWeekStart,
                    'end_date' => $curWeekEnd,
                ];
                $curWeekStart = $curWeekEnd->copy()->addDay(2);
            }
            // Create a WeeklyReport for each week in the month
            foreach ($weeks as $week) {
                WeeklyReport::create([
                    'start_date' => $week['start_date'],
                    'end_date' => $week['end_date'],
                    'monthly_report_id' => $monthlyReport->id,
                ]);
            }
        });
    }
}
