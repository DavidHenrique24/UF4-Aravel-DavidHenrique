<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:100|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'role' => 'required|string|in:user,admin',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = User::create([
            'name' => $request->get ('name'),
            'email' => $request->get ('email'),
            'password' => bcrypt($request->get ('password')),
            'role' => $request->get ('role'),
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
            return response()->json(['message' => $validator->errors()], 400);
        }
        $credentials = $request->only('email', 'password');

        try {
            if(! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized'], 401);
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
        $user = Auth::user();
        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => $user,
        ], 200);


    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logout successful'], 200);
    }	








}
