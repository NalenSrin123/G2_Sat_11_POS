<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderStatusLogsController extends Controller
{
    public function index()
    {
        $logs = OrderStatusLog::with('order')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $logs,
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'changed_by' => 'nullable|integer',
            'old_status' => 'required|string|max:100',
            'new_status' => 'required|string|max:100',
            'changed_at' => 'nullable|date',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $data = $validate->validated();
        $data['changed_at'] = $data['changed_at'] ?? now();

        $log = OrderStatusLog::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Create success',
            'data' => $log->load('order'),
        ], 201);
    }

    public function show($id)
    {
        $log = OrderStatusLog::with('order')->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $log,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'changed_by' => 'nullable|integer',
            'old_status' => 'required|string|max:100',
            'new_status' => 'required|string|max:100',
            'changed_at' => 'nullable|date',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $log = OrderStatusLog::findOrFail($id);
        $log->update($validate->validated());

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $log->load('order'),
        ], 200);
    }

    public function destroy($id)
    {
        $log = OrderStatusLog::findOrFail($id);
        $log->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $log,
        ], 200);
    }
}
