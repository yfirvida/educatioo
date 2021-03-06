<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name','intro','link','courses_limit','groups_limit','students_limit'];

    /*public function users()
    {
        return $this->hasMany(User::class);
    }*/

    public static function all_items($sort = 'name', $order = 'asc') {
        return Plan::orderBy($sort, $order)->get();
    }

    public static function getByName($name) {
        return Plan::where('name', $name)->first();
    }
}
