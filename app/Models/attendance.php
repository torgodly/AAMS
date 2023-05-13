<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'is_present',
    ];

    //attendance belongs to student
//    public function student()
//    {
//        return $this->belongsTo(Student::class, 'student_id');
//    }

}
