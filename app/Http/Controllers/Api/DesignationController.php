<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Http\Requests\DesignationRequest;
use App\Http\Requests\DesignationUpdateRequest;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $designation =  Designation::all();
       return response()->json([
        'designation' => $designation,
        'status' => 200,
        'message' => "Designation retrieved successfully",
       ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesignationRequest $request)
    {
        $validated =  $request->validated();
        $designations = $request->designation_name;

        foreach($designations as $designation){
            Designation::create([
                'designation_name' => $designation,
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => "Designation was created successfully",
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
       $designation = Designation::find($id);
        return response()->json([
            'designation' => $designation,
            'status' => 200,
            'message' => "Department was successfully retrieved",
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DesignationUpdateRequest $request, $id)
    {
        Designation::find($id)->
        update([
            'designation_name' => $request->designation_name,
        ]);

        return response()->json([
            'status' => 200,
            'message' => "Designation was updated successfully",
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
       Designation::find($id)->delete();
       return response()->json([
        'status' => 200,
        'message' => "Designation was deleted successfully",
    ]);
    }
}
