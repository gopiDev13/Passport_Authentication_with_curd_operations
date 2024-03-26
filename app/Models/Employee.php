<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'emp_name',
        'email',
        'department_id',
        'designation_id',
        'address',
        'phone_number',
    ];

    public function designationName()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function departmentName()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
