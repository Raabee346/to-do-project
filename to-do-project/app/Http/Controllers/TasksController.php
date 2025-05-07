<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    
    public function show(Request $request){
        $user=$request->user();
        $UserTasks=Tasks::where('user_id', $user->id)->get();

        return response()->json([
            'success'=>true,
            'reason'=>null,
            'response' =>$UserTasks,
        ]);
    }

    public function create(Request $request){
        $UserID=$request->user()->id;
        $NewTask= Tasks::create([
            'user_id' => $UserID,
            'title' =>$request->title,
            'description'=>$request->description
        ]);

    return response()->json([
        'success'=>true,
        'reason'=>'created',
        'response'=>$NewTask
    ]);
 }

 public function delete(Request $request, $id){
   $UserID = $request->user()->id;

   Tasks::where('user_id',$UserID)->where('id',$id)->delete();

   return response()->json([
        'error'=> false,
        'reason'=> 'deleted',
        'response'=> null
   ]);
 }

 public function complete(Request $request, $id){
    $UserID = $request->user()->id;
    $Task = Tasks::where('user_id',$UserID)->where('id',$id)->first();

    $Task->update([
        'completed'=>!$Task->completed,
    ]);
    return response()->json([
        'error'=> false,
        'reason'=> 'updated',
        'response'=> $Task
    ]);
}

public function favorite(Request $request,$id){
    $UserID = $request->user()->id;
    $Task = Tasks::where('user_id',$UserID)->where('id',$id)->first();

    $Task->update([
        'favorite'=>!$Task->favorite,
    ]);
    return response()->json([
        'error'=> false,
        'reason'=> 'updated',
        'response'=> $Task
    ]);
}
}
