<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
        return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $product
            ], 200);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors()
            ], 200);
        };
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by
        ]);
        return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $validate
            ], 200);
    }

    public function show($id){
        $product = Product::FindOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $product
        ], 200);
    }

    public function destroy($id){
        $product = Product::FindOrFail($id);
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $product
        ], 200);
    }

    public function update(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);
        $product = Product::find($id);
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $product
        ], 200);
    }
}
