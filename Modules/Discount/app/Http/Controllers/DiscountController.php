<?php

namespace Modules\Discount\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Discount\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::all();

        return response()->json([
            'message' => 'Discounts retrieved successfully.',
            'discounts' => $discounts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('discount::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:percentage,fixed',
            'value'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status'      => 'boolean',
        ]);

        $discount = Discount::create($validated);

        return response()->json([
            'message' => 'Discount created successfully.',
            'discount' => $discount
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $discount = Discount::findOrFail($id);

        return response()->json([
            'discount' => $discount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $discount = Discount::findOrFail($id);

        return view('discount::edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'type'        => 'sometimes|required|in:percentage,fixed',
            'value'       => 'sometimes|required|numeric|min:0',
            'description' => 'nullable|string',
            'status'      => 'boolean',
        ]);

        $discount->update($validated);

        return response()->json([
            'message' => 'Discount updated successfully.',
            'discount' => $discount
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);

        $discount->delete();

        return response()->json([
            'message' => 'Discount deleted successfully.'
        ]);
    }
}