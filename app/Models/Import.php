<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'code',
        'active'
    ];

    public function exams()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public static function verify($course_id, $code) {
        $result = false;
        $imp = Import::where('exam_id', $course_id)->where('code', $code)->first();
        if($imp && $imp->active){$result = true;}
        return $result;
    }

    public static function deactive($course_id, $code) {
        $imp = Import::where('exam_id', $course_id)->where('code', $code)->first();
        $imp->active = false;
        $imp->save();
        return $imp;
    }
}
