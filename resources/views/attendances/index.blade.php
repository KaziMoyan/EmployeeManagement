@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Attendance List</h2>
        <a href="{{ route('attendances.create') }}" class="btn btn-success">➕ Record Attendance</a>
    </div>
  <!-- Search Bar -->
  <form method="GET" action="{{ route('attendances.index') }}">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search Employee..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">🔍 Search</button>
    </div>
</form>
<!-- Attendance Table -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->employee->name }}</td>
                    <td>{{ $attendance->date_time_in }}</td>
                    <td>{{ $attendance->date_time_out ?? 'Not Checked Out' }}</td>
                    <td>
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-primary btn-sm">✏️ Edit</a>
                        @if (!$attendance->date_time_out)
                        
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning btn-sm">Check-out</a>
                        @endif
                       

                        
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Delete</button>
                        </form>
                    
                            <a href="{{ route('attendances.history', $attendance->employee_id) }}" class="btn btn-info">📊 View History</a>
                        
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection  
