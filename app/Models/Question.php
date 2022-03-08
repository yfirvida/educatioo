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
        return $this->belongsToMany(Exam::class)->withPivot('show_in_result', 'latest_question');
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

    public function replicateRow()
    {
       $clone = $this->replicate();
       $clone->push();
         
       foreach($this->answers as $answer)
       {
           $clone->answers()->create($answer->toArray());
       }
  
       $clone->save();

       return $clone;
    }

}
