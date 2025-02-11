<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
    protected $fillable = ['employee_id', 'date_time_in', 'date_time_out'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
