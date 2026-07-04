<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::with(['items.product', 'statusLogs', 'table'])->latest()->get();

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $orders,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch orders',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'customer_id' => 'nullable|integer',
                'table_id' => 'nullable|exists:restaurant_tables,id',
                'waiter_id' => 'nullable|integer',
                'cashier_id' => 'nullable|integer',
                'cooker_id' => 'nullable|integer',
                'discount_id' => 'nullable|integer',
                'discount_applied' => 'boolean',
                'order_type' => 'nullable|string|max:100',
                'status' => 'nullable|string|max:100',
                'total_amount' => 'nullable|numeric|min:0',
                'discount_amount' => 'nullable|numeric|min:0',
                'final_amount' => 'nullable|numeric|min:0',
                'notes' => 'nullable|string',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error',
                    'data' => $validate->errors(),
                ], 422);
            }

            $data = $validate->validated();
            $data['total_amount'] = $data['total_amount'] ?? 0;
            $data['discount_amount'] = $data['discount_amount'] ?? 0;
            $data['final_amount'] = $data['final_amount'] ?? max($data['total_amount'] - $data['discount_amount'], 0);

            $order = Order::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Create success',
                'data' => $order->load(['items.product', 'statusLogs', 'table']),
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $order = Order::with(['items.product', 'statusLogs', 'table'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $order,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'customer_id' => 'nullable|integer',
                'table_id' => 'nullable|exists:restaurant_tables,id',
                'waiter_id' => 'nullable|integer',
                'cashier_id' => 'nullable|integer',
                'cooker_id' => 'nullable|integer',
                'discount_id' => 'nullable|integer',
                'discount_applied' => 'boolean',
                'order_type' => 'nullable|string|max:100',
                'status' => 'nullable|string|max:100',
                'total_amount' => 'nullable|numeric|min:0',
                'discount_amount' => 'nullable|numeric|min:0',
                'final_amount' => 'nullable|numeric|min:0',
                'notes' => 'nullable|string',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error',
                    'data' => $validate->errors(),
                ], 422);
            }

            $order = Order::findOrFail($id);
            $data = $validate->validated();

            if (! array_key_exists('final_amount', $data)) {
                $total = $data['total_amount'] ?? $order->total_amount ?? 0;
                $discount = $data['discount_amount'] ?? $order->discount_amount ?? 0;
                $data['final_amount'] = max($total - $discount, 0);
            }

            $order->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Update success',
                'data' => $order->load(['items.product', 'statusLogs', 'table']),
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return response()->json([
                'status' => true,
                'message' => 'Delete success',
                'data' => $order,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
