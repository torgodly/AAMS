<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parental\HasParent;

class Teacher extends User
{
    use HasParent;
    use SoftDeletes;


    //teacher has one group
    public function group()
    {
        return $this->hasOne(Group::class , 'teacher_id');
    }
}
