<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role as ModelsRole;

class RoleController extends Controller
{
    public function index()
    {
        try {
            return response()->json(ModelsRole::latest()->get());
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to fetch roles',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $role = ModelsRole::create($data);

            return response()->json([
                'message' => 'Role created successfully',
                'data' => $role,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to create role',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $role = ModelsRole::findOrFail($id);

            return response()->json($role);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Role not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $role = ModelsRole::findOrFail($id);

            $data = $request->validate([
                'name' => 'sometimes|required|string|max:255|unique:roles,name,' . $role->id,
                'description' => 'required|string',
            ]);

            $role->update($data);

            return response()->json([
                'message' => 'Role updated successfully',
                'data' => $role->fresh(),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to update role',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $role = ModelsRole::findOrFail($id);
            $role->delete();

            return response()->json([
                'message' => 'Role deleted successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to delete role',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
