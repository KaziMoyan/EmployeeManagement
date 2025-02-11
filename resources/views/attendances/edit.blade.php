@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Attendance</h2>
    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Employee:</label>
        <input type="text" value="{{ $attendance->employee->name }}" class="form-control" disabled>

        <label>Check-in Time:</label>
        <input type="datetime-local" name="date_time_in" value="{{ date('Y-m-d\TH:i', strtotime($attendance->date_time_in)) }}" required class="form-control">

        <label>Check-out Time:</label>
        <input type="datetime-local" name="date_time_out" value="{{ $attendance->date_time_out ? date('Y-m-d\TH:i', strtotime($attendance->date_time_out)) : '' }}" class="form-control">

        <br>
        <button type="submit" class="btn btn-primary">Update Attendance</button>
    </form>
</div>
@endsection
