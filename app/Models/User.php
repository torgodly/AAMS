<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Parental\HasChildren;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasChildren;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'group_id',
        'type'
    ];

    protected $childTypes = [
        'admin' => Admin::class,
        'Student' => Student::class,
        'Teacher' => Teacher::class,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //create scope for Teachers
    public function scopeTeachers($query)
    {
        return $query->where('role', 'teacher');
    }
    //create scope for Students
    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }

    //create scope for Admins
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    //is_admin
    public function isAdmin()
    {
        return $this->type === 'admin';
    }
}
