<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        //
        $departments =  Department::all();

        return response()->json([
            'department' => $departments,
            'status' => 200,
            'message' => "Department retrieved successfully",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        //
          $validated_request = $request->validated();

          $departments = $request->department_name;

          foreach($departments as $department){

                Department::create([
                    'department_name' => $department,
                ]);
          }

          return response()->json([
            'status' => 200,
            'message' => 'Department created successfully',
          ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request , $id)
    {
       if($id){
            $department =  Department::find($id);

            return response()->json([
                'department' => $department,
            ]);
       }
       return response()->json([
        'message' => "please provide correct Id",
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentUpdateRequest $request, $id)
    {
        if($id){

            $department_validated = $request->validated();
            Department::where('id',$request->id)->update([
                'department_name' => $request->department_name,
            ]);

            return response()->json([
                'status' => 200,
                'message' => "Department updated successfully",
            ]);
        }
        return response()->json([
            'message' => "please provide correct Id",
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    {
        
        if($id){
            Department::find($id)->delete();
            return response()->json([
                'status' => 200,
                'message' => "Department deleted",
            ]);
        }
        return response()->json([
            'message' => "please provide correct Id",
        ]);
    }

    public function logout(Request $request){

        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
}
