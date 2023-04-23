<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $user = User::select('id','name', 'email', 'created_at')->where('id', '=', Auth::user()->id)->first();
        return response()->json($user);
    }

     /**
     * Create a new User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the request data using Laravel's validate method
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user using the validated data and Hash the password using Laravel's Hash facade
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Return a JSON response with the created user and a HTTP status code of 201 Created
        return response()->json(['user' => $user], 201);
    }


    /**
     * Get a single User by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }

    /**
     * Update a User by ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the user with the given id
        $user = User::findOrFail($id);

        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
        ]);

        // Update the user's name and email with the validated data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Save the updated user record to the database
        $user->update();

        // Return the updated user record in JSON format
        return response()->json(['user' => $user]);
    }


    public function password(Request $request, $user_id)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the authenticated user ID matches the user ID being updated
        if ($user->id != $user_id) {
            // If not, return an error response with a 403 status code
            return response()->json(['error' => 'You are not authorized to update this user\'s password.'], 403);
        }

        // Validate the incoming request data
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:6',
        ]);

        // Check if the user's current password matches the inputted current password
        if (!Hash::check($request->input('currentPassword'), $user->password)) {
            // If not, return an error response with a 422 status code
            return response()->json(['error' => 'The current password you entered is incorrect.'], 422);
        }

        // Update the user's password with the new hashed password
        $user->password = Hash::make($request->input('newPassword'));
        $user->save();

        // Return a success response with the updated user object and a 200 status code
        return response()->json(['message' => 'Password updated successfully.', 'user' => $user], 200);
    }




    /**
     * Delete a User by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
