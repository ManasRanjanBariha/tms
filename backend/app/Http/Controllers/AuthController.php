<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=>$request->role,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
    // dd("hyy");
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);


        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }


        $token = $user->createToken('Personal Access Token')->plainTextToken;


        return response()->json([
            'token' => $token,
            'message' => 'Logged in successfully',
            'data' =>$user
        ]);
    }

    public function show(Request $request)
    {
        $user = $request->user();

        // Return user details as a JSON response
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ]);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);


        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Return a response with the updated user details
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);
    }

}
