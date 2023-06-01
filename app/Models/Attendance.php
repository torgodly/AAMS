<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'date',
        'is_present',
        'memorization',
    ];

    //attendance belongs to student
   public function student()
   {
       return $this->belongsTo(Student::class, 'student_id');
   }

}
