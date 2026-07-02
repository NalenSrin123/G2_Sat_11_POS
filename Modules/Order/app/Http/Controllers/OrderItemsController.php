<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemsController extends Controller
{

    public function index()
    {
        $items = OrderItem::with(['order', 'product'])->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $items,
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'subtotal' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $data = $validate->validated();
        $data['subtotal'] = $data['subtotal'] ?? ($data['quantity'] * $data['unit_price']);

        $item = OrderItem::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Create success',
            'data' => $item->load(['order', 'product']),
        ], 201);
    }

    public function show($id)
    {
        $item = OrderItem::with(['order', 'product'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $item,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'subtotal' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error',
                'data' => $validate->errors(),
            ], 422);
        }

        $item = OrderItem::findOrFail($id);
        $data = $validate->validated();
        $data['subtotal'] = $data['subtotal'] ?? ($data['quantity'] * $data['unit_price']);

        $item->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Update success',
            'data' => $item->load(['order', 'product']),
        ], 200);
    }

    public function destroy($id)
    {
        $item = OrderItem::findOrFail($id);
        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete success',
            'data' => $item,
        ], 200);
    }
}
