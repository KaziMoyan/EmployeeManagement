@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Edit Employee</h2>
            <div class="d-flex">
                <a href="{{ route('employees.create') }}" class="btn btn-success me-2">➕ Add New Employee</a>
                <a href="{{ route('employees.index') }}" class="btn btn-primary">📋 View Employee List</a>
            </div>
        </div>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Name:</label>
            <input type="text" name="name" value="{{ $employee->name }}" required class="form-control">

            <label>Salary:</label>
            <input type="number" name="salary" value="{{ $employee->salary }}" required class="form-control">

            <label>Joining Date:</label>
            <input type="date" name="joining_date" value="{{ $employee->joining_date }}" required class="form-control">

            <label>Phone:</label>
            <input type="text" name="phone" value="{{ $employee->phone }}" required class="form-control">

            <label>Email:</label>
            <input type="email" name="email" value="{{ $employee->email }}" required class="form-control">

            <label>RFID:</label>
            <input type="text" name="RFID" value="{{ $employee->RFID }}" required class="form-control">

            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
