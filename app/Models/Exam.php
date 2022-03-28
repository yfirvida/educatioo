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
        return $this->belongsToMany(Classroom::class)->withPivot('start', 'end', 'min_points', 'total_points','email_instructions', 'certificate_id', 'archive')->orderBy('pivot_start','asc');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot('show_in_result', 'latest_question', 'created_at', 'first_question')->orderBy('pivot_created_at','asc');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function imports()
    {
        return $this->hasMany(Import::class);
    }

    public function countQuestions() 
    {
        return $this->questions()->count();
    }

    public static function all_items($user) {
        return Exam::where('author', $user)->orderBy('name', 'asc')->paginate(10);
    }
    
    public static function all_items2($user) {
        return Exam::where('author', $user)->orderBy('name', 'asc')->get();
    }
    public static function activeExams($id){
        $now = date('Y-m-d H:i:s');
        return Exam::where('author', $id)->WhereHas('classrooms', function ($query) use($now){ 
            $query->where('end', '>=', $now); })->paginate(10);
    }

    public static function currectExam($id){
        $now = date('Y-m-d H:i:s');
        return Exam::WhereHas('classrooms', function ($query) use($now , $id){ 
            $query->where('start', '<=', $now)->where('end', '>=', $now)->where('exam_id', '>=', $id); })->first();
    }

    public static function getTotalPoints($exam_id, $class_id){
   
        $exam = Exam::find($exam_id);
        $pivot = $exam->classrooms->find($class_id);

         return $pivot->pivot->total_points;
    }
    public static function getMinPoints($exam_id, $class_id){
   
        $exam = Exam::find($exam_id);
        $pivot = $exam->classrooms->find($class_id);

         return $pivot->pivot->min_points;
    }

    public static function listForResult($id){
        $now = date('Y-m-d H:i:s');
        return Exam::WhereHas('classrooms', function ($query) use($now , $id){ 
            $query->where('start', '<=', $now)->where('archive', '=', 0)->where('classroom_id', '=', $id); })->get();
    }

    public static function archive($id){
        $now = date('Y-m-d H:i:s');
        return Exam::where('author', $id)->WhereHas('classrooms', function ($query) { 
            $query->where('archive', '=', 1); })->paginate(10);
    }
}
