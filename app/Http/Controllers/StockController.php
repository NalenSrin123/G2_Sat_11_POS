<?php

namespace Modules\Stock\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $stocks,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stock::create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
                'data' => $validate->errors(),
            ], 422);
        }

        $stock = Stock::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'low_stock_thredhold' => $request->low_stock_thredhold,
            'updated_at' => $request->updated_at,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $stock,
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $stock = Stock::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $stock,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('stock::edit');
    }

    /**
     * Update the specified resource in storage.
     */
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
                'data' => $validate->errors(),
            ], 422);
        }

        $stock = Stock::findOrFail($id);

        $stock->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'low_stock_thredhold' => $request->low_stock_thredhold,
            'updated_at' => $request->updated_at,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $stock,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $stock,
        ], 200);
    }
}
