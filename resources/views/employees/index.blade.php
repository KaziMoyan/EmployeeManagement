@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Employee List</h2>
            <a href="{{ route('employees.create') }}" class="btn btn-success">➕ Add New Employee</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>RFID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>{{ $employee->joining_date }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->RFID }}</td>
                        <td>
                            <a href="{{route('employees.edit',$employees->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{route('employees.destroy',$employees->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
