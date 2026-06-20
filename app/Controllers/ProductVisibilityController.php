<?php

namespace App\Http\Controllers;

use App\Models\ProductVisibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductRoleController extends Controller
{
    public function index()
    {
        $productRole = ProductVisibility::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $productRole
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'role_id' => 'required|exists:roles,id',
            'is_visible' => 'boolean'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors()
            ], 200);
        }

        $productRole = ProductVisibility::create([
            'product_id' => $request->product_id,
            'role_id' => $request->role_id,
            'is_visible' => $request->is_visible
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Create success',
            'data' => $productRole
        ], 200);
    }

    public function show($id)
    {
        $productRole = ProductVisibility::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $productRole
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'role_id' => 'required|exists:roles,id',
            'is_visible' => 'boolean'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors()
            ], 200);
        }

        $productRole = ProductVisibility::findOrFail($id);

        $productRole->update([
            'product_id' => $request->product_id,
            'role_id' => $request->role_id,
            'is_visible' => $request->is_visible
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $productRole
        ], 200);
    }

    public function destroy($id)
    {
        $productRole = ProductVisibility::findOrFail($id);

        $productRole->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $productRole
        ], 200);
    }
}