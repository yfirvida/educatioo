<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'school',
        'land_id',
        'last_session',
        'subscription_date',
        'plan',
        'total_students',
        'trainer_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->withPivot("pin");
    }

    public function land()
    {
        return $this->belongsTo(Land::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function isAdmin() {
       return $this->role === 'admin';
    }

    public function isTrainer() {
       return $this->role === 'trainer';
    }
    
    public function isStudent() {
       return $this->role === 'student';
    }

    public static function allStudents($id){
        return User::where('trainer_id', $id)->where('role','student')->get();
    }

    public static function allStudentsOutThisClassroom($id , $class){
        return User::where('trainer_id', $id)->where('role','student')->whereDoesntHave('classrooms')->orWhereHas('classrooms', function ($query) use($class){ $query->where('classroom_id', '<>', $class); })->get();
    }
}
