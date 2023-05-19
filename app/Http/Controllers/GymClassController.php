<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerMembership;
use App\Models\Employee;
use App\Models\CustomerClass;
use App\Models\Membership;
use App\Models\GymClass;
use App\Models\User;
use DB;

class GymClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = GymClass::orderBy('id','asc')->paginate(10);
   
        return view('gymclass.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('gymclass.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => ['required'],
            'schedule' => 'required',
            'description' => 'required',
            'max_enrollees' => 'required',
            'start' => ['required','regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]$/'],
            'end' => ['required','regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]$/'],
            'apm' => 'required',
        ]);

        $gymclass = new GymClass;
        $gymclass->name =  strtoupper($request->input('name'));
        $gymclass->price = $request->input('price');
        $gymclass->schedule = $request->input('schedule');
        $gymclass->description = $request->input('description');
        $gymclass->max_enrollees = $request->input('max_enrollees');
        $gymclass->cur_number = 0;
        $apm=$request->input('apm');
        

        $end=str_split($request->input('end'),2);

        if(strcmp($end[0],"12")==0){
            if($request->input('apm')=='AM'){
                $apm="PM";
            }else if($request->input('apm')=='PM'){
                $apm="AM";
            }
        }

        $time=$request->input('start') . ' ' . $request->input('apm') . ' - ' .$request->input('end') . ' ' . $apm;
        $gymclass->time = $time;

        $gymclass->save();
        

        return redirect('/gymclass')->with('success', 'Gym Class Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gymclass = GymClass::find($id);
        //$emp = StaffDetails::where ('customer_id', '=', $id)->first();
        //$emp = Membership::where ('id','=',$customships->membership_id)->first();

        $customclass = CustomerClass::join('customers', 'customers.id', '=', 'customer_classes.customer_id')
                                    ->where('class_id', '=', $id)
                                    ->select('*','customer_classes.id as cc_id')
                                    ->orderBy('customer_id',"asc")
                                    ->paginate(10);
        
        $instructors = DB::table('users')
                     ->join('staff_details','users.id', '=', 'staff_details.employee_id')
                     ->where('class_id', '=', $id)
                     ->select('users.id as employee_id','users.firstname as employeefirstname','users.lastname as employeelastname')
                     ->get();

        foreach ($customclass as $key) {
            
            $customships = CustomerMembership::where ('customer_id', '=', $key->customer_id)->first();
            $mem = Membership::where ('id','=',$customships->membership_id)->first();
            
            $key->name=$mem->name;
        }


        $data = [
            'gymclass' => $gymclass,
            'customer' => $customclass,
            'instructors' => $instructors
        ];

        //return $customclass;
        return view('gymclass.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $gymclass = GymClass::find($id);

        $arr=explode(" ",$gymclass->time);
        
        $data=[
            'time'=>$arr,
            'gymclass'=>$gymclass
        ];


        return view('gymclass.edit')->with($data);
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
        $this->validate($request,[
            'name' => 'required',
            'price' => ['required'],
            'schedule' => 'required',
            'description' => 'required',
            'max_enrollees' => 'required',
            'start' => 'required',
            'end' => 'required',
            'start' => ['required','regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]$/'],
            'end' => ['required','regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]$/'],
            'apm' => 'required',
        ]);

        $gymclass = GymClass::find($id);
        $gymclass->name = $request->input('name');
        $gymclass->price = $request->input('price');
        $gymclass->status = $request->input('status');
        $gymclass->schedule = $request->input('schedule');
        $gymclass->description = $request->input('description');
        $gymclass->max_enrollees = $request->input('max_enrollees');
        $gymclass->cur_number = 0;
        $apm=$request->input('apm');
        

        $end=str_split($request->input('end'),2);

        if(strcmp($end[0],"12")==0){
            if($request->input('apm')=='AM'){
                $apm="PM";
            }else if($request->input('apm')=='PM'){
                $apm="AM";
            }
        }

        $time=$request->input('start') . ' ' . $request->input('apm') . ' - ' .$request->input('end') . ' ' . $apm;
        $gymclass->time = $time;

        $gymclass->save();
        

        return redirect('/gymclass')->with('success', 'Gym Class Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $gymclass = GymClass::find($request->class_delete_id);

        $customclass = CustomerClass::where('class_id', '=', $request->class_delete_id);
        foreach ($customclass as $key ) {
            $key->delete();
        }

        $gymclass->delete();

        return redirect('/gymclass')->with('success', 'Gym Class Deleted Successfully');
    }
    

}
