<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'employee_no',
        'hire_date',
        'salary',
        'shift',
        'created_by',
    ];
}
