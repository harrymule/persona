<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
            );

            if($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            // Validate the incoming request data
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            // Check if validation fails
            if($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            // Attempt to authenticate user with email and password
            if(!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            // Get the user with the given email
            $user = User::where('email', $request->email)->first();

            // Return a response with a token for the authenticated user
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function resetPassword(Request $request)
{
    try {
        // Validate the request
        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required'
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 401);
        }

        // Update user password
        $user->password = Hash::make($request->password);
        $user->save();

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Password reset successful',
        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}

public function changePassword(Request $request)
{
    try {
        // Validate request data
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        // Get the current user
        $user = Auth::user();

        // Verify the current password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Current password is incorrect',
            ], 401);
        }

        // Update the password
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully',
        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}


}
