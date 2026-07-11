<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $products,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch products',
                'error' => $e->getMessage(),
            ], 500);
        }
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
        try {
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
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $product,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch product',
                'error' => $e->getMessage(),
            ], 500);
        }
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
        try {
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
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'status' => true,
                'message' => 'Delete success',
                'data' => $product,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
