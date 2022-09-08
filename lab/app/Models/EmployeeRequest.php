<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeRequest extends Model
{
    //

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
