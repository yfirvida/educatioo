<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['level'];

    public static function all_items($sort = 'level', $order = 'asc') {
        return Level::orderBy($sort, $order)->get();
    }
}
