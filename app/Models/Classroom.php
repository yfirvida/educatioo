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

    public function exams()
    {
        return $this->belongsToMany(Exam::class)->withPivot('start', 'end', 'utc_start', 'utc_end', 'min_points' , 'total_points', 'email_instructions', 'certificate_id', 'archive')->orderBy('pivot_start','asc');
    }

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

    public static function activeExams($id){
        $now = new DateTime();
        $now->setTimeZone(new DateTimeZone('UTC'));
        $now = $now->format('Y-m-d H:i:s');

        return Classroom::where('trainer_id', $id)->WhereHas('exams', function ($query) use($now){ 
            $query->where('utc_start', '<=', $now)->where('utc_end', '>=', $now); })->get();
    }

    


}
