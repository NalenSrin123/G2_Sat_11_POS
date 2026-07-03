<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            "role_id" => "required|integer|exists:roles,id",
            "name" => "required|string|max:250",
            "email" => "required|email|max:250|unique:users,email",
            "password" => "required|string|min:8",
            "phone" => "required|string",
            "is_active" => "required|boolean"
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json([
            "message" => "Register Successfully",
            "user" => $user
        ], 201);
    }

    public function index()
    {
        $user = User::with('role')->get();

        return response()->json([
            "message" => "Retrieved All Users Successfully",
            "user" => $user
        ], 200);
    }

    public function show($id)
    {
        $user = User::with('role')->find($id);

        if (!$user) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        return response()->json([
            "message" => "User Retrieved Successfully",
            "user" => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        $validated = $request->validate([
            "role_id" => "required|integer|exists:roles,id",
            "name" => "required|string|max:250",
            "email" => "required|email|max:250|unique:users,email," . $id,
            "password" => "nullable|string|min:8",
            "phone" => "required|string",
            "is_active" => "required|boolean"
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            "message" => "User Updated Successfully",
            "user" => $user
        ], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        $user->delete();

        return response()->json([
            "message" => "User Deleted Successfully"
        ], 200);
    }
}