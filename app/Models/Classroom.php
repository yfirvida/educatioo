<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level_id',
        'trainer_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot("pin");
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public static function all_items($user) 
    {
        return Classroom::where('trainer_id', $user)->orderBy('name', 'asc')->get();
    }

    public function getCountUsers()
    {
        return $this->users()->count();
    }
}
