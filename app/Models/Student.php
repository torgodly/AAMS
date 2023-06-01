<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Parental\HasParent;

class Student extends User
{
    use HasParent;
    use SoftDeletes;

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








}
