<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\Classroom;
use App\Models\level;

class WelcomeController extends Controller
{
    public function show()
    {
        return view('welcome');
    }

    public function authByPin()
    {
        $response = '';
        $pin = $_POST['pin'];
        $name = $_POST['name'];
        $response = Classroom::with(['users' => function($q) use ($pin) { $q->where('classroom_user.pin', $pin);}])->with(['exams' => function($qq) use ($name) { $qq->where('exams.name', $name);}])->get();

        
        if(!$response->isEmpty()){
            $level = Level::find($response[0]->level_id);
            $response['level'] = $level->level;
        }
        

        return JSON_ENCODE($response);
    }

}
