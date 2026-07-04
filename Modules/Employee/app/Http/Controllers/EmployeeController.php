<?php

namespace Modules\Employee\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            $employees = Employee::with(['user', 'creator'])->get();

            return response()->json([
                'message' => 'Employees retrieved successfully',
                'employees' => $employees
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to fetch employees',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'employee_no' => 'required|string|unique:employees,employee_no',
                'hire_date' => 'required|date',
                'salary' => 'required|numeric|min:0',
                'shift' => 'required|string|max:50',
                'created_by' => 'required|exists:users,id',
            ]);

            $employee = Employee::create($validated);

            return response()->json([
                'message' => 'Employee created successfully',
                'employee' => $employee
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to create employee',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $employee = Employee::with(['user', 'creator'])->findOrFail($id);

            return response()->json([
                'employee' => $employee
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Employee not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'employee_no' => 'required|string|unique:employees,employee_no,' . $id,
                'hire_date' => 'required|date',
                'salary' => 'required|numeric|min:0',
                'shift' => 'required|string|max:50',
                'created_by' => 'required|exists:users,id',
            ]);

            $employee->update($validated);

            return response()->json([
                'message' => 'Employee updated successfully',
                'employee' => $employee
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to update employee',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json([
                'message' => 'Employee deleted successfully'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to delete employee',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}