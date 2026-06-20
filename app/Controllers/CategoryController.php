<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // show data
    public function index(){
        // $category = Category::latest()->paginate(10);
        $category = categories::all();
        return response()->json([
            'status' => true,
            'message' => 'All Category',
            'data' => $category,
        ], 200);
    }

    // store data
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
            
        ]);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Error Validate',
                'data' => $validate->errors(),
            ]);
        }
        $category = categories::create([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Created Category Successful',
            'data' => $validate, 
        ]);
    }

    // show data with id
    public function show($id){
        $category = categories::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $category
        ],200);
    }

    // delete data with id
    public function destroy($id){
        $category = categories::findOrFail($id);
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete success',
            'data'  => $category
        ],200);
    }
    
    // update data with id
    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => 'update fails',
                'data' => $validate->errors()
            ],422);
        }
        $category = categories::find($id);
        $category->update([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by
        ]);
        return response()->json([
            'status' => true,
            'message' => 'update category success',
            'data' => $category
        ],200);
    }
}
