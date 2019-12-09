<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'attendance_employees', 'attend_id', 'emp_id' )->withPivot('type');
    }

}
