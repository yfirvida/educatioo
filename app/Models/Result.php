<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'launch_id',
        'classroom_id',
        'result',
        'next_question',
        'archive',
        'detail'
    ];

    protected $casts = ['detail' => 'array'];

    public static function getValue($launch_id, $user_id)
    {
        $q = Result::where('launch_id', $launch_id)->where('user_id', $user_id)->first();
        $result = 0;
        if($q): $result = $q->result; endif;
        return $result;
    }

    public static function getNext($launch_id, $user_id)
    {
        $q = Result::where('launch_id', $launch_id)->where('user_id', $user_id)->first();
        $result = -1;
        if($q): $result = $q->next_question; endif;
        return $result;
    }

    public static function getDetail($launch_id, $user_id)
    {
        $q = Result::where('launch_id', $launch_id)->where('user_id', $user_id)->first();
        $result = 0;
        if($q): $result = $q->detail; endif;
        return $result;
    }
}
