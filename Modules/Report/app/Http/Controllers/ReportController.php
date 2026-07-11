<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $report = Report::with('user')->get();

            return response()->json([
                'Message' => 'Report Retrived Successfully',
                'report' => $report,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to fetch reports',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'report_type' => 'required|string',
                'period_start' => 'required|date',
                'period_end' => 'required|date|after_or_equal:period_start',
                'generated_by' => 'required|exists:users,id',
                'payload' => 'nullable|string',
                'generated_at' => 'nullable|date',
            ]);

            $report = Report::create($validated);

            return response()->json([
                'message' => 'Report created successfully',
                'report' => $report,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to create report',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $report = Report::with('user')->findOrFail($id);

            return response()->json([
                'message' => 'Report retrieved successfully',
                'report' => $report,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Report not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $report = Report::findOrFail($id);

            $validated = $request->validate([
                'report_type' => 'required|string',
                'period_start' => 'required|date',
                'period_end' => 'required|date|after_or_equal:period_start',
                'generated_by' => 'required|exists:users,id',
                'payload' => 'nullable|string',
                'generated_at' => 'nullable|date',
            ]);

            $report->update($validated);

            return response()->json([
                'message' => 'Report updated successfully',
                'report' => $report,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to update report',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $report = Report::findOrFail($id);
            $report->delete();

            return response()->json([
                'message' => 'Report deleted successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to delete report',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
