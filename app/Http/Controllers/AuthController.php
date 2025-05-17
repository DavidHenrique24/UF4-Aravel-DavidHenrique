<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,user',
            'email' => 'required|email|string|max:100|unique:users',
            'password' => 'required|string|min:5|confirmed',


        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = User::create([
            'name' => $request->get ('name'),
            'email' => $request->get ('email'),
            'role' => $request->get('role'),
            'password' => bcrypt($request->get ('password')),

        ]);
        return response()->json([
            'message' => 'User created successfully',
         'data' => $user],
         201);



    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:100',
            'password' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        $credentials = $request->only('email', 'password');

        try {
            if(! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid Credenciales'],
                 401);
            }
            return response()->json(['message' => 'Login successful',
             'token' => $token], 200);

        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token',
             'message' => $e->getMessage()], 500);
        }
    }

    public function getUser()
    {
    //     $user = Auth::user();
     $user = JWTAuth::parseToken()->authenticate();
        return response()->json([
          'message' => 'User Conseguido caramba',
           'data' => $user,
       ], 200);
   }




    public function logout()
    {
        try{
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message'=> 'User Logged out sucefuly'
            ], 200);
        }catch (JWTException $e){
            return response()->json ([
                'message' => 'No se pudo Logear'
            ],500);
        }
    }








}
