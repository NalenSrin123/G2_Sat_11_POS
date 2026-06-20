<?php

namespace App\Http\Controllers;

use App\Models\restaurant_tables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantTableController extends Controller
{
    public function index()
    {
        $tables = restaurant_tables::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $tables
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
                'data' => $validate->errors()
            ], 200);
        }

        $table = restaurant_tables::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Create success',
            'data' => $table
        ], 200);
    }

    public function show($id)
    {
        $table = restaurant_tables::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $table
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
                'data' => $validate->errors()
            ], 200);
        }

        $table = restaurant_tables::findOrFail($id);

        $table->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $table
        ], 200);
    }

    public function destroy($id)
    {
        $table = restaurant_tables::findOrFail($id);

        $table->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $table
        ], 200);
    }
}