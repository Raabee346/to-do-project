<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //list all activities
    public function list(Request $request){
        $UserID = $request->user()->id;
        $Activities = Activity::where('user_id',$UserID)->get();

        return response()->json([
            'error' => false,
            'reason' => 'listed',
            'response' => $Activities
        ]);
    }

// mark as read all activities
public function read(Request $request){
    $UserID = $request->user()->id;
    Activity::where('user_id',$UserID)->update(['unread' => false]);

    return response()->json([
        'error' => false,
        'reason' => 'read',
        'response' => null
    ]);
}

//delete selected activity
public function delete(Request $request, $id){
    $UserID = $request->user()->id;
    Activity::where('user_id',$UserID)->where('id',$id)->delete();

    return response()->json([
        'error' => false,
        'reason' => 'deleted',
        'response' => null
    ]);
}
}
