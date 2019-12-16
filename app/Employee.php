<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'job_type');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendance()
    {
        return $this->belongsToMany(Attendance::class, 'attendance_employees', 'emp_id', 'attend_id')->withPivot('type');;
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function lga()
    {
        return $this->belongsTo(LGA::class, 'lga_id');
    }
}
