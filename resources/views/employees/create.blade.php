@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Add Employee</h2>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">📋 View Employee List</a>
        </div>
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" required class="form-control">
            
            <label>Salary:</label>
            <input type="number" name="salary" required class="form-control">
            
            <label>Joining Date:</label>
            <input type="date" name="joining_date" required class="form-control">
            
            <label>Phone:</label>
            <input type="text" name="phone" required class="form-control">
            
            <label>Email:</label>
            <input type="email" name="email" required class="form-control">
            
            <label>RFID:</label>
            <input type="text" name="RFID" required class="form-control">
            
            <br>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
