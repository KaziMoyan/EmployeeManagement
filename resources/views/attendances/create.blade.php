@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Record Attendance</h2>
        <a href="{{ route('attendances.index') }}" class="btn btn-info">📋 View Attendance List</a>
    </div>

    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <label>Employee:</label>
        <select name="employee_id" class="form-control" required>
            <option value="">Select Employee</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>

        <label>Check-in Time:</label>
        <input type="datetime-local" name="date_time_in" required class="form-control">

        <br>
        <button type="submit" class="btn btn-success">Check-in</button>
    </form>
</div>
@endsection
