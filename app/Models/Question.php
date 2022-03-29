<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'question',
        'intro',
        'image',
        'value'
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class)->withPivot('show_in_result', 'latest_question', 'created_at', 'first_question')->orderBy('pivot_created_at','asc');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function questionById($id)
    {
        $q = Question::find($id);
        $result = 'None';
        if($q): $result = $q->identifier; endif;
        return $result;
    }

    public static function literalById($id)
    {
        $q = Question::find($id);
        $result = 'None';
        if($q): $result = $q->question; endif;
        return $result;
    }

    public function replicateRow()
    {
       $clone = $this->replicate();
       $clone->push();
         
       foreach($this->answers as $answer)
       {
            $answer->next_question = null;
           $clone->answers()->create($answer->toArray());
       }
  
       $clone->save();

       return $clone;
    }

    public static function firstQuestion($id){
        return Question::WhereHas('exams', function ($query) use($id){ 
            $query->where('exam_id', '=', $id)->where('first_question', '=', 1); })->first();
    }


}
