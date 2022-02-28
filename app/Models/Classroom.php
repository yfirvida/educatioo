<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Classroom extends Model
{
    use HasFactory;

    public static function all_items($user) {
        return Classroom::where('trainer_id', $user)->orderBy('name', 'asc')->get();
    }
}
