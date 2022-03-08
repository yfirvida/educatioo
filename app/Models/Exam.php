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
}
