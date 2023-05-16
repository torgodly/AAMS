<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{
    use HasFactory;

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
}
