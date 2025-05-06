<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    
    public function show(Request $request){
        $user=$request->user();
        $UserTasks=Tasks::where('user_id', $user->id)->get();

        return $UserTasks;
    }
}
