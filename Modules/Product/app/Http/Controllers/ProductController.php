<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $products,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $product,
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $product,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $product = Product::findOrFail($id);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $product,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $product,
        ], 200);
    }
}
