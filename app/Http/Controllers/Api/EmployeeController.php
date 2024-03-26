<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $employees = Employee::with(['departmentName','designationName'])->get();
       return response()->json([
        'employees' => $employees,
        'status' => 200,
        'message' => "Employee successfully retreived",
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
       Employee::create([
        'emp_name' => $request->emp_name,
        'email' => $request->email,
        'department_id' => $request->department_id,
        'designation_id' => $request->designation_id,
        'address' => $request->address,
        'phone_number' => $request->phone_number,
       ]);

       return response()->json([
        'status' => 200,
        'message' => "Employee was created successfully",
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::with(['designationName', 'departmentName'])->find($id);
       
        return response()->json([
            'status' => 200,
            'message' => "Employee was retrieved successfully",
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {
        $employee = Employee::find($id)->update([
            'emp_name' => $request->emp_name,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'designation_id' => $request->designation_id,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        return response()->json([
            'Updated Employee Details' => $employee,
            'status' => 200,
            'message' => "Employee was successfully updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => "Employee was deleted successfully",
        ]);
    
    }
}