<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\Classroom;
use App\Models\Level;

use DB;

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

        $response = \DB::table('classrooms')
        ->join('classroom_user', 'classroom_user.classroom_id', '=', 'classrooms.id')
        ->join('users', 'users.id', '=', 'classroom_user.user_id')
        ->join('classroom_exam', 'classroom_exam.classroom_id', '=', 'classrooms.id')
        ->join('exams', 'exams.id', '=', 'classroom_exam.exam_id')
        ->where('classroom_user.pin', '=', $pin)
        ->where('exams.name', '=', $name)
        ->select('users.*', 'classroom_exam.classroom_id', 'classroom_exam.exam_id', 'exams.level_id', 'classrooms.name As class', 'users.id As user_id')->get();

       

        
        if(!$response->isEmpty()){
            $level = Level::find($response[0]->level_id);
            $response['level'] = $level->level;
        }
        

        return JSON_ENCODE($response);
    }

}
