<?php

namespace Modules\Restaurant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantTableController extends Controller
{
    public function index()
    {
        $tables = RestaurantTable::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $tables,
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,reserved',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $table = RestaurantTable::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Create success',
            'data' => $table,
        ], 201);
    }

    public function show($id)
    {
        $table = RestaurantTable::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $table,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,reserved',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $table = RestaurantTable::findOrFail($id);

        $table->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $table,
        ], 200);
    }

    public function destroy($id)
    {
        $table = RestaurantTable::findOrFail($id);
        $table->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $table,
        ], 200);
    }
}
