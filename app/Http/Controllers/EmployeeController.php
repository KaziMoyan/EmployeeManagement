<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        
        $employees = Employee::all();

        return view('employees.index', compact('employees'));

        //return response()->json($employees);
    }

    public function create()
    {
        
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'salary' => 'required|numeric',
            'joining_date' => 'required|date',
            'phone' => 'required',
            'email' => 'required|email|unique:employees',
            'RFID' => 'required|unique:employees',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }
    

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'salary' => 'required|numeric',
            'joining_date' => 'required|date',
            'phone' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'RFID' => 'required|unique:employees,RFID,' . $employee->id,
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
    
}
