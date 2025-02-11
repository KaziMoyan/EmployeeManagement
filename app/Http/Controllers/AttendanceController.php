<?php
namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller {
    public function index() {
        $attendances = Attendance::with('employee')->get();
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_time_in' => 'required|date',
            'date_time_out' => 'nullable|date|after_or_equal:date_time_in',
        ]);
    
        $attendance = Attendance::findOrFail($id);
        $attendance->update([
            'date_time_in' => $request->date_time_in,
            'date_time_out' => $request->date_time_out,
        ]);
    
        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }
    

    public function destroy(Attendance $attendance) {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
}
