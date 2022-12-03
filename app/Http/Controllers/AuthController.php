<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Resources\UserResource;


class AuthController extends Controller {
    /**
     * User Login
     */
    public function login(Request $request) {

        $responseData = [
            'success' => false,
            'message' => '',
            'data'    => null
        ];


        $validator = Validator::make($request->all(), [
            'email'     =>  'required|email',
            'password'  =>  'required|string'
        ]);

        if ($validator->fails()) {
            $responseData['message'] = $validator->errors()->first();


            return response($responseData, 400);
        }

        // Check Email
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            $responseData['message'] = 'Invalid email and password';
            return response($responseData, 400);
        }

        $responseData['success'] = true;
        $responseData['message'] = 'Authentication successful!';
        $responseData['data'] = [
            'user'  => $user,
            'token' => $user->createToken('todo')->plainTextToken
        ];

        return response($responseData, 200);   
    }

    public function fetchID($email) {
        return DB::table('users')->select('id')->where('email', $email)->get();
    }

   
   
   


}
