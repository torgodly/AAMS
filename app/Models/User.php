<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'group_id',
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

    //create relatcionship between groups and users teachers

    public function group()
    {
        return $this->belongsTo(Group::class);
    }



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
}
