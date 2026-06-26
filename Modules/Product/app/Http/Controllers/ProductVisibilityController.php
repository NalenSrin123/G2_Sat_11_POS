<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductVisibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductVisibilityController extends Controller
{
    public function index()
    {
        $visibility = ProductVisibility::with(['product', 'role'])->get();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $visibility,
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'role_id' => 'required|exists:roles,id',
            'is_visible' => 'boolean',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $visibility = ProductVisibility::create([
            'product_id' => $request->product_id,
            'role_id' => $request->role_id,
            'is_visible' => $request->is_visible ?? true,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Create success',
            'data' => $visibility,
        ], 201);
    }

    public function show($id)
    {
        $visibility = ProductVisibility::with(['product', 'role'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $visibility,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'role_id' => 'required|exists:roles,id',
            'is_visible' => 'boolean',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $visibility = ProductVisibility::findOrFail($id);

        $visibility->update([
            'product_id' => $request->product_id,
            'role_id' => $request->role_id,
            'is_visible' => $request->is_visible ?? true,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $visibility,
        ], 200);
    }

    public function destroy($id)
    {
        $visibility = ProductVisibility::findOrFail($id);
        $visibility->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $visibility,
        ], 200);
    }
}
