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
}
