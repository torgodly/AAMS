<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeeklyReport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
        'commitment',
        'ethics',
        'units',
        'exam',
        'monthly_report_id'
    ];


    public function monthlyReport()
    {

        $this->belongsTo(MonthlyReport::class, 'monthly_report_id');
    }




}
