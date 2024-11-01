<?php

// app/Http/Controllers/CustomerController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // Display all customers
    public function index()
    {
        $customers = DB::table('customers')->get();
        return view('customers.index', compact('customers'));
    }

    // Show form to create a customer
    public function create()
    {
        return view('customers.create');
    }

    // Store new customer
    public function store(Request $request)
    {
        DB::table('customers')->insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer added successfully');
    }

    // Show form to edit customer
    public function edit($id)
    {
        $customer = DB::table('customers')->where('customer_id', $id)->first();
        return view('customers.edit', compact('customer'));
    }

    // Update customer data
    public function update(Request $request, $id)
    {
        DB::table('customers')->where('customer_id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'updated_at' => now(),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    // Delete customer
    public function destroy($id)
    {
        DB::table('customers')->where('customer_id', $id)->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }

   
}
