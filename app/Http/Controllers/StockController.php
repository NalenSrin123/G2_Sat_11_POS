<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    public function index()
    {
        $stock = Stock::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $stock
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'low_stock_thredhold' => 'required|integer|min:0',
            'updated_at' => 'nullable|date',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors()
            ], 200);
        }

        $stock = Stock::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'low_stock_thredhold' => $request->low_stock_thredhold,
            'updated_at' => $request->updated_at
        ]);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $stock
        ], 200);
    }

    public function show($id)
    {
        $stock = Stock::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $stock
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'low_stock_thredhold' => 'required|integer|min:0',
            'updated_at' => 'nullable|date',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors()
            ], 200);
        }

        $stock = Stock::findOrFail($id);

        $stock->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'low_stock_thredhold' => $request->low_stock_thredhold,
            'updated_at' => $request->updated_at
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $stock
        ], 200);
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);

        $stock->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $stock
        ], 200);
    }
}