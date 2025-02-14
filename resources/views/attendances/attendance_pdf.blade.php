<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Attendance Report for {{ $employee->name }}</h2>
    <h2>Email: {{ $employee->email }}</h2>
    <h2>Phone: {{ $employee->phone }}</h2>
    <p><strong>Total Full Days:</strong> {{ $fullDays }} days</p>
    <p><strong>Remaining Time:</strong> {{ $remainingHours }} hours, {{ $remainingMinutes }} minutes</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Worked Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                @php
                    $checkIn = \Carbon\Carbon::parse($attendance->date_time_in);
                    $checkOut = $attendance->date_time_out ? \Carbon\Carbon::parse($attendance->date_time_out) : null;
                    $workedHours = $checkOut ? $checkIn->diffInHours($checkOut) : 0;
                @endphp
                <tr>
                    <td>{{ $checkIn->toDateString() }}</td>
                    <td>{{ $checkIn->format('h:i A') }}</td>
                    <td>{{ $checkOut ? $checkOut->format('h:i A') : 'Not Checked Out' }}</td>
                    <td>{{ $workedHours }} hours</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
