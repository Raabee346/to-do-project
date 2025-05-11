<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;


    Route::post('/user/register', [AuthController::class, 'register']);

    Route::post('/user/login', [AuthController::class, 'login']);


    Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/user/logout/{id}', [AuthController::class, 'logout']);

    //get all tasks of user
    Route::get('/user/tasks',[TasksController::class, 'show']);

    // add tasks
    Route::post('/task/create', [TasksController::class,'create']);

    //delete tasks
    Route::delete('/task/delete/{id}', [TasksController::class,'delete']);

    //completed tasks
    Route::get('/task/complete/{id}', [TasksController::class,'complete']);

    //favorite tasks
    Route::get('/task/favorite/{id}', [TasksController::class,'favorite']);

    //update tasks
    Route::post('/task/update/{id}',[TasksController::class,'update']);

    //list all activities
    Route::get('/activities',[ActivityController::class,'list']);

    //mark as read activities
    Route::post('/activities/read/{id}',[ActivityController::class,'read']);

    //delete activities
    Route::delete('/activities/delete/{id}',[ActivityController::class,'delete']);

});

