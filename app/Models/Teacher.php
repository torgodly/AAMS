<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class Teacher extends User
{
    use HasParent;


    //teacher has one group
    public function group()
    {
        return $this->hasOne(Group::class , 'teacher_id');
    }
}
