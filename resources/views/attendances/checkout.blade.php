@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Check-out for {{ $attendance->employee->name }}</h2>
    
    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <label for="date_time_out">Check-Out Time:</label>
        <input type="datetime-local" name="date_time_out" value="{{ old('date_time_out', $attendance->date_time_out) }}" required>
    
        <button type="submit">Update Attendance</button>
    </form>
    
</div>
@endsection
