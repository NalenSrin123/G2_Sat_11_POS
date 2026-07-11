<?php

namespace Modules\Kitchen\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('kitchen::index');
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to render kitchen page',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('kitchen::create');
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to render kitchen create page',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            return view('kitchen::show');
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to render kitchen show page',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            return view('kitchen::edit');
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to render kitchen edit page',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
