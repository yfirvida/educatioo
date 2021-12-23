<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'iso',
        'name',
        'nicename',
        'iso3',
        'numcode',
        'phonecode'
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function all_items($sort = 'name', $order = 'asc') {
        return Land::orderBy($sort, $order)->get();
    }
}
