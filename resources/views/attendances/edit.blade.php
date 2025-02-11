@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Update Attendance</h2>

    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Employee:</label>
        <input type="text" value="{{ $attendance->employee->name }}" class="form-control" disabled>

        <label>Check-in Time:</label>
        <input type="text" value="{{ $attendance->date_time_in }}" class="form-control" disabled>

        <label>Check-out Time:</label>
        <input type="datetime-local" name="date_time_out" required class="form-control">

        <br>
        <button type="submit" class="btn btn-primary">Check-out</button>
    </form>
</div>
@endsection
