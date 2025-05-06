<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class AuthController extends Controller {

    public function register (Request $request) {

        $Validate = Validator::make($request->all(), [
            'fname'      => 'required|string|max:100',
            'lname'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8'
        ]);

        // validation
        if ($Validate->fails()) {
            $Errors = $Validate->errors();

            if ($Errors->has('email')) return 'The email has already been taken.';
            else return 'validation error';

        }

        // register the user
        return User::create($request->all());

    }

    public function login (Request $request) {
        $Validate = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|string|min:8'
        ]);

        // validation
        if ($Validate->fails()) {
            return 'validation error';
        }

        $User = User::where('email', $request->email)->first();
        if (!$User || !Hash::check($request->password, $User->password)) {
            return "email and password didn't matched";
        }

        // create token and return
        $token = $User->createToken('user')->plainTextToken;

        return [
            'success'   => true,
            'token'     => $token
        ];

    }

    public function logout (Request $request, $id) {
        $request->user()->tokens()->delete();
        return 'logout successfully!';
    }

}