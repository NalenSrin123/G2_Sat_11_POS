<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => true,
            'message' => 'All Category',
            'data' => $categories,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $category = Category::create([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Created Category Successful',
            'data' => $category,
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $category,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     */
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
                'data' => $validate->errors(),
            ], 422);
        }

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'update category success',
            'data' => $category,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'delete success',
            'data' => $category,
        ], 200);
    }
}
