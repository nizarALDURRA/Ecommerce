<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {

        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'userType' => 'required',
                'password' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors(),
                ], 401);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'userType' => $request->userType,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'user has been created successfully',
                'user' => $user->createToken("API TOKEN")->plainTextToken,
                'statusCode' => 200
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function loginUser(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors(),
                ], 401);
            }
            if (!Auth::attempt($request->only(['email','userType','password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'email or password is not correct',
                ], 401);
            }

            $user = User::where('email',$request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'user logged in successfully',
                'user' => $user->createToken("API TOKEN")->plainTextToken,
                'statusCode' => 200
            ]);

        } catch (Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ], 500);

        }
    }
}
