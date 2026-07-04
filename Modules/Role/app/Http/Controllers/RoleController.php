<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Modules\Auth\Models\Role as AuthModelsRole;


class RoleController extends Controller
{
    /**
     * GET /roles
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json([
            'status' => true,
            'message' => 'Roles retrieved successfully',
            'data' => $roles
        ]);
    }

    /**
     * POST /roles
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|in:waiter,cashier,cooker,admin,super_admin|unique:roles,name',
            'description' => 'required|max:255',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Role created successfully',
            'data' => $role
        ], 201);
    }

    /**
     * GET /roles/{id}
     */
    public function show($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Role retrieved successfully',
            'data' => $role
        ]);
    }

    /**
     * PUT /roles/{id}
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|in:waiter,cashier,cooker,admin,super_admin|unique:roles,name,' . $id,
            'description' => 'required|max:255',
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Role updated successfully',
            'data' => $role
        ]);
    }

    /**
     * DELETE /roles/{id}
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found'
            ], 404);
        }

        $role->delete();

        return response()->json([
            'status' => true,
            'message' => 'Role deleted successfully'
        ]);
    }
}