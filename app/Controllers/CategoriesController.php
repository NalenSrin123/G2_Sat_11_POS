<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

    public function index()
    {
        // $category = Categories::latest()->paginate(10);  
        $category = Categories::all();
        return response()->json([
            'status' => true,
            'message' => 'All Categories',
            'data' => $category,
        ], 200);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error Validate',
                'data' => $validate->errors(),
            ], 422);
        }

        $category = Categories::create($request->only([
            'name',
            'image_url',
            'is_active',
            'created_by'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Created Categories Successful',
            'data' => $category,
        ], 201);
    }
    public function show($id)
    {
        $category = Categories::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $category
        ], 200);
    }
    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete success',
            'data'  => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'update fails',
                'data' => $validate->errors()
            ], 422);
        }

        $category = Categories::findOrFail($id);
        $category->update($request->only([
            'name',
            'image_url',
            'is_active',
            'created_by'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'update categories success',
            'data' => $category
        ], 200);
    }
}
