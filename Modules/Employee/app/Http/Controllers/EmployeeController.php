<?php

namespace Modules\Employee\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'creator'])->get();

        return response()->json([
            'message' => 'Employees retrieved successfully',
            'employees' => $employees
        ]);
    }

    public function store(Request $request)
    {
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
    }

    public function show($id)
    {
        $employee = Employee::with(['user', 'creator'])->find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        return response()->json([
            'employee' => $employee
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

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
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully'
        ]);
    }
}