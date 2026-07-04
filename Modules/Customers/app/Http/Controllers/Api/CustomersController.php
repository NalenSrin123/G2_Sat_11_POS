<?php

namespace Modules\Customers\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;


class CustomersController extends Controller
{
    // GET ALL + SEARCH
    public function index(Request $request)
    {
        $search = $request->search;

        $customers = Customers::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%");
        })->latest()->get();

        return response()->json($customers);
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required'
        ]);

        $customer = Customers::create($request->all());

        return response()->json([
            'message' => 'Customer created',
            'data' => $customer
        ]);
    }

    // SHOW
    public function show($id)
    {
        $customer = Customers::findOrFail($id);

        return response()->json($customer);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $customer = Customers::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required'
        ]);

        $customer->update($request->all());

        return response()->json([
            'message' => 'Customer updated',
            'data' => $customer
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);

        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted'
        ]);
    }
}
