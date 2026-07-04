<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
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
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        try {
            $user = User::with('role')->get();

            return response()->json([
                "message" => "Retrieved All Users Successfully",
                "user" => $user
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to fetch users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::with('role')->findOrFail($id);

            return response()->json([
                "message" => "User Retrieved Successfully",
                "user" => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to fetch user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

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
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                "message" => "User Deleted Successfully"
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to delete user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}