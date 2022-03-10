<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'author',
        'level_id'
    ];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->withPivot('start', 'end', 'min_points', 'email_instructions', 'certificate_id')->orderBy('pivot_start','asc');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot('show_in_result', 'latest_question', 'created_at')->orderBy('pivot_created_at','asc');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function countQuestions() 
    {
        return $this->questions()->count();
    }

    public static function all_items($user) {
        return Exam::where('author', $user)->orderBy('name', 'asc')->get();
    }

    public static function activeExams($id){
        $now = date('Y-m-d H:i:s');
        return Exam::where('author', $id)->WhereHas('classrooms', function ($query) use($now){ 
            $query->where('start', '<=', $now)->where('end', '>=', $now); })->get();
    }
}
