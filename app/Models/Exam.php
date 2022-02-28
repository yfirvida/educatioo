<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public static function all_items($user) {
        return Exam::where('author', $user)->orderBy('name', 'asc')->get();
    }
}
