<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateTimeZone;
use DB;

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
        return $this->belongsToMany(Classroom::class)->withPivot('id','start', 'end', 'utc_start', 'utc_end', 'min_points', 'total_points','email_instructions', 'certificate_id', 'archive')->orderBy('pivot_start','asc');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot('show_in_result', 'latest_question', 'created_at', 'first_question')->orderBy('question_id','asc');
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
        $now = new DateTime();
        $now->setTimeZone(new DateTimeZone('UTC'));
        $now = $now->format('Y-m-d H:i:s');
        
        return Exam::where('author', $id)->WhereHas('classrooms', function ($query) use($now){ 
            $query->where('utc_end', '>=', $now); })->paginate(10);
    }

    public static function currectExam($id){
        $now = new DateTime();
        $now->setTimeZone(new DateTimeZone('UTC'));
        $now = $now->format('Y-m-d H:i:s'); 
        return Exam::WhereHas('classrooms', function ($query) use($now , $id){ 
            $query->where('utc_start', '<=', $now)->where('utc_end', '>=', $now)->where('exam_id', '>=', $id); })->first();
    }

    public static function getTotalPoints($launch_id){
   
        $pivot = \DB::table('classroom_exam')->where('id', $launch_id)->first();

         return $pivot->total_points;
    }
    public static function getMinPoints($launch_id){
   
        $pivot = \DB::table('classroom_exam')->where('id', $launch_id)->first();

         return $pivot->min_points;
    }

    public static function listForResult($id){
        $now = new DateTime();
        $now->setTimeZone(new DateTimeZone('UTC'));
        $now = $now->format('Y-m-d H:i:s');

        $pivot = \DB::table('classroom_exam')
        ->where('utc_start', '<=', $now)->where('archive', '=', 0)->where('classroom_id', '=', $id)
        ->join('exams', 'exams.id', '=', 'classroom_exam.exam_id')
        ->select('exams.*', 'classroom_exam.start' , 'classroom_exam.end' ,'classroom_exam.id As launch_id')->get();

        return $pivot;
    }

    public static function QuestionsForResults() 
    {
         return $this->questions()->wherePivot('show_in_result', 1 )->get();
    }

    public static function GetByLaunch($launch_id) 
    {
        $pivot = \DB::table('classroom_exam')->where('classroom_exam.id', '=', $launch_id)
        ->join('exams', 'exams.id', '=', 'classroom_exam.exam_id')
        ->join('classrooms', 'classrooms.id', '=', 'classroom_exam.classroom_id')
        ->select('exams.*', 'classrooms.name AS class', 'classrooms.id AS class_id', 'classroom_exam.total_points AS total_points', 'classroom_exam.min_points AS min_points',)->get();
       
         return $pivot;
    }

    public static function archive($id){
        return Exam::where('author', $id)->WhereHas('classrooms', function ($query) { 
            $query->where('archive', '=', 1); })->paginate(10);
    }
}
