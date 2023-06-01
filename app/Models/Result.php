<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use stdClass;

class Result extends Model
{
    use HasFactory;

    public static function getWeeklyScores($startDate, $endDate)
    {
        $students = Auth::user()->group->students()
            ->whereHas('monthlyReports', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate]);
            })
            ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate])
                    ->where('is_present', true);
            }, 'monthlyReports.weeklyReports' => function ($query) use ($endDate) {
                $query->where('end_date', $endDate);
            }])
            ->get();

        $scoresArr = [];

        foreach ($students as $student) {
            $scores = new stdClass();
            $scores->name = $student->name;
            $scores->commitment = 0;
            $scores->ethics = 0;
            $scores->exam = 0;
            $scores->attendance = 0;
            $scores->units = 0;
            $scores->total = 0;

            foreach ($student->monthlyReports as $monthlyReport) {
                foreach ($monthlyReport->weeklyReports as $weeklyReport) {

                    $attendanceScore = $student->attendances
                        ->whereBetween('date', [$weeklyReport->start_date, $weeklyReport->end_date])
                        ->sum(function ($attendance) {
                            return $attendance->memorization + 2;
                        });

                    $scores->commitment += $weeklyReport->commitment;
                    $scores->ethics += $weeklyReport->ethics;
                    $scores->exam += $weeklyReport->exam;
                    $scores->attendance += $attendanceScore;
                    $scores->units += $weeklyReport->units;
                    $scores->total += $weeklyReport->exam + $attendanceScore + $weeklyReport->ethics + $weeklyReport->commitment;
                }
            }

            $scoresArr[] = $scores;
        }

        return $scoresArr;
    }

    public static function getMonthlyScores($startDate, $endDate)
    {
        $students = Auth::user()->group->students()->whereHas('monthlyReports', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate]);
        })
            ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate])->where('is_present', true);
            }, 'monthlyReports.weeklyReports'])
            ->get();

        $scoresArr = [];
        $activityScores = [];

        foreach ($students as $student) {
            $scores = new stdClass();
            $scores->name = $student->name;
            $scores->commitment = 0;
            $scores->ethics = 0;
            $scores->exam = 0;
            $scores->attendance = 0;
            $scores->units = 0;
            $scores->activity = 0;
            $scores->fiqh = 0;
            $scores->khata = 0;
            $scores->ahkam = 0;
            $scores->activity_rank = null;

            foreach ($student->monthlyReports as $monthlyReport) {
                $scores->fiqh += $monthlyReport->fiqh;
                $scores->khata += $monthlyReport->khata;
                $scores->ahkam += $monthlyReport->ahkam;
                foreach ($monthlyReport->weeklyReports as $weeklyReport) {

                    $attendanceScore = $student->attendances
                        ->whereBetween('date', [$weeklyReport->start_date, $weeklyReport->end_date])
                        ->sum(function ($attendance) {
                            return $attendance->memorization + 2;
                        });

                    $scores->commitment += $weeklyReport->commitment;
                    $scores->ethics += $weeklyReport->ethics;
                    $scores->exam += $weeklyReport->exam;
                    $scores->attendance += $attendanceScore;
                    $scores->units += $weeklyReport->units;
                    $scores->activity += $weeklyReport->exam + $attendanceScore + $weeklyReport->ethics + $weeklyReport->commitment;
                }
            }

            $activityScores[] = $scores->activity;
            $scoresArr[] = $scores;
        }

        rsort($activityScores); // Sort activity scores in descending order
        $prevScore = null;
        $rank = null;

        foreach ($activityScores as $key => $score) {
            if ($prevScore === null || $prevScore !== $score) {
                $rank = $key + 1; // Assign new rank number for unique score
            }
            $prevScore = $score;
            $activityRanks[$score] = $rank; // Assign rank number to score
        }

        foreach ($scoresArr as &$scores) {
            $activityScore = $scores->activity;
            $scores->activity_rank = $activityRanks[$activityScore];
        }

        return $scoresArr;
    }


}
