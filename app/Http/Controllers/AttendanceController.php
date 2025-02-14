<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class AttendanceController extends Controller {
    public function index(Request $request) {
        $today = now()->toDateString(); // Get today's date
    
        $query = Attendance::with('employee')->whereDate('date_time_in', $today);
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }
    
        $attendances = $query->get();
        
        return view('attendances.index', compact('attendances'));
    }
    
    

    public function create() {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request) {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date_time_in' => 'required|date',
        ]);

        Attendance::create([
            'employee_id' => $request->employee_id,
            'date_time_in' => $request->date_time_in,
        ]);

        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
    }

    public function edit($id) {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }
    public function update(Request $request, $id) {
        $attendance = Attendance::findOrFail($id);
    
        $request->validate([
            'date_time_in' => 'required|date',
            'date_time_out' => 'nullable|date|after_or_equal:date_time_in',
        ]);
    
        // Allow updating both check-in and check-out
        $attendance->update([
            'date_time_in' => $request->date_time_in,  // Allow updating check-in time
            'date_time_out' => $request->date_time_out, // Allow updating check-out time
        ]);
    
        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }
    
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
    
        if (!$attendance) {
            return redirect()->back()->with('error', 'Attendance record not found.');
        }
    
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance record deleted successfully.');
    }
      
    
    public function history($employee_id) {
        $attendances = Attendance::where('employee_id', $employee_id)->get();
    
        $totalMinutes = 0;
    
        foreach ($attendances as $attendance) {
            if ($attendance->date_time_in && $attendance->date_time_out) {
                $checkIn = \Carbon\Carbon::parse($attendance->date_time_in);
                $checkOut = \Carbon\Carbon::parse($attendance->date_time_out);
                $totalMinutes += $checkIn->diffInMinutes($checkOut);
            }
        }
    
        // Convert total minutes to days and remaining hours/minutes
        $fullDays = intdiv($totalMinutes, 480); // 8 hours = 480 minutes
        $remainingMinutes = $totalMinutes % 480;
        $remainingHours = intdiv($remainingMinutes, 60);
        $remainingMinutes = $remainingMinutes % 60;
    
        return view('attendances.history', compact('attendances', 'fullDays', 'remainingHours', 'remainingMinutes'));
    }
    public function downloadAttendancePDF($employee_id)
{
    $employee = Employee::findOrFail($employee_id);
    $attendances = Attendance::where('employee_id', $employee_id)->get();

    $totalMinutes = 0;

    foreach ($attendances as $attendance) {
        if ($attendance->date_time_in && $attendance->date_time_out) {
            $checkIn = Carbon::parse($attendance->date_time_in);
            $checkOut = Carbon::parse($attendance->date_time_out);
            $totalMinutes += $checkIn->diffInMinutes($checkOut);
        }
    }

    // Convert total minutes to days, hours, and minutes
    $fullDays = intdiv($totalMinutes, 480); // 8 hours = 480 minutes
    $remainingMinutes = $totalMinutes % 480;
    $remainingHours = intdiv($remainingMinutes, 60);
    $remainingMinutes = $remainingMinutes % 60;

    // Generate PDF
    $pdf = Pdf::loadView('attendances.attendance_pdf', compact('employee', 'attendances', 'fullDays', 'remainingHours', 'remainingMinutes'));

    return $pdf->download("Attendance_Report_{$employee->name}.pdf");
}

public function checkOut($id) {
    $attendance = Attendance::findOrFail($id);
    return view('attendances.checkout', compact('attendance'));
}

    

}