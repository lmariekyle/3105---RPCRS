<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymClass;
use App\Models\User;
use App\Models\StaffDetails;
use DB;

class StaffDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $emp= StaffDetails::where(['employee_id' => $request->employee_id, 'class_id' => $request->class_id]);

        if($emp!=NULL){
            $instructor= StaffDetails::create([
                'employee_id' => $request->employee_id,
                'class_id' => $request->class_id,
            
            ]);

            return back()->with('success', 'Instructor added successfully');

        }else{

            return back()->with('error', 'Cannot add instructor to the same class');

        }

    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // SHOW ASSIGN INSTRUCTOR
        $gymclass = GymClass::find($id);
        $employees = User::role('Instructor')->get();
        $gymdetails =  StaffDetails::where('class_id', '=', $id)->get();
        $instructors = DB::table('users')
                     ->join('staff_details','users.id', '=', 'staff_details.employee_id')
                     ->where('class_id', '=', $id)
                     ->select('users.id as employee_id','users.firstname as employeefirstname','users.lastname as employeelastname')
                     ->get();
        return view('gymclass.instructor',compact('gymclass','employees','gymdetails','instructors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $instructor =  StaffDetails::where('employee_id', '=', $id);
        $instructor->delete();

        return back()->with('success', 'Instructor Deleted Successfully');
    }
}
