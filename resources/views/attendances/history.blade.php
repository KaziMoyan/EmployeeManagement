@extends('layouts.app')

@section('content')
<div class="card shadow-lg p-4 mb-4">
    <h3 class="text-primary d-flex justify-content-between">
        📊 Total Attendance Summary
        <a href="{{ route('attendances.download_pdf', $attendances->first()->employee_id) }}" class="btn btn-danger btn-sm">📥 Download PDF</a>
    </h3>
    <p><strong>✅ Total Days Worked:</strong> {{ $fullDays }} days</p>
    <p><strong>⏳ Extra Time:</strong> {{ $remainingHours }} hours, {{ $remainingMinutes }} minutes</p>
</div>

<table class="table table-striped table-bordered">
    <thead class="bg-dark text-white">
        <tr>
            <th>Date</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Worked Hours</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attendances as $attendance)
            @php
                $checkIn = \Carbon\Carbon::parse($attendance->date_time_in);
                $checkOut = $attendance->date_time_out ? \Carbon\Carbon::parse($attendance->date_time_out) : null;
                $workedHours = $checkOut ? $checkIn->diffInHours($checkOut) : 0;
                $workedMinutes = $checkOut ? $checkIn->diffInMinutes($checkOut) % 60 : 0;
            @endphp
            <tr>
                <td>{{ $checkIn->toDateString() }}</td>
                <td>{{ $checkIn->format('h:i A') }}</td>
                <td>{{ $checkOut ? $checkOut->format('h:i A') : 'Not Checked Out' }}</td>
                <td>{{ $workedHours }}h {{ $workedMinutes }}m</td>
                <td>
                    <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
