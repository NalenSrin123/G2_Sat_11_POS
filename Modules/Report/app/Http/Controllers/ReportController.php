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
        $report = Report::with('user')->get();

        return response()->json([
            'Message' => 'Report Retrived Successfully',
            'report' => $report,
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::with('user')->find($id);

        if (!$report) {
            return response()->json([
                'message' => 'Report not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Report retrieved successfully',
            'report' => $report,
        ]);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json([
                'message' => 'Report not found',
            ], 404);
        }

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json([
                'message' => 'Report not found',
            ], 404);
        }

        $report->delete();

        return response()->json([
            'message' => 'Report deleted successfully',
        ]);
    }
}
