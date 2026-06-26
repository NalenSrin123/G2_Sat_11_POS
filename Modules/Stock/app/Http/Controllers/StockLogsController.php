<?php

namespace Modules\Stock\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockLogsController extends Controller
{
    public function index()
    {
        $logs = StockLog::with(['product', 'order'])->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $logs,
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'order_id' => 'nullable|exists:orders,id',
            'changed_by' => 'nullable|integer',
            'change_qty' => 'required|integer',
            'reason' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $log = StockLog::create($validate->validated());

        return response()->json([
            'status' => true,
            'message' => 'Create success',
            'data' => $log->load(['product', 'order']),
        ], 201);
    }

    public function show($id)
    {
        $log = StockLog::with(['product', 'order'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $log,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'order_id' => 'nullable|exists:orders,id',
            'changed_by' => 'nullable|integer',
            'change_qty' => 'required|integer',
            'reason' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $log = StockLog::findOrFail($id);
        $log->update($validate->validated());

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $log->load(['product', 'order']),
        ], 200);
    }

    public function destroy($id)
    {
        $log = StockLog::findOrFail($id);
        $log->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $log,
        ], 200);
    }
}
