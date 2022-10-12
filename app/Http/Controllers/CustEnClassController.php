<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerMembership;
use App\Models\CustomerClass;
use App\Models\Membership;
use App\Models\GymClass;

class CustEnClassController extends Controller
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
    public function create($id)
    {   
    /*    $customer = Customer::find($id);
        $classes = GymClass::paginate(10);
        $customships = CustomerMembership::where ('customer_id', '=', $id)->first();
        $membership = Membership::where ('id','=',$customships->membership_id)->first();
        $enrolled = CustomerClass::join('customers', 'customers.id', '=', 'customer_classes.customer_id')
                    ->join('gym_classes', 'gym_classes.id', '=', 'customer_classes.class_id')
                    ->where ('customer_id', '=', $id)
                    ->select('*','customer_classes.id as cc_id')
                    ->orderBy('customers.id',"asc")
                    ->paginate(10);

        $data = [
            'customer' => $customer,
            'membership' => $membership,
            'classes' => $classes,
            'enrolled' => $enrolled
        ];
        
        return view('members.enroll')->with($data);*/

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)    
    {
        $enrolled = CustomerClass::where(['customer_id', '=', $id],['class_id', '=', $request->input('class')]);
        

        $cc = new CustomerClass;
        $cc->class_id = $request->input('class');
        $cc->customer_id = $request->input('customer');
        $cc->save();
        $class = GymClass::where('id','=',$request->input('class'))->first();
        $class->cur_number=$class->cur_number+1;
        $class->save();


        return redirect(url('/members'.'/'.$id.'/class/create'))->with('success', 'Class Enrolled');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $customclass = CustomerClass::findOrFail($id);
        $customer = $customclass->customer_id;
        $class = GymClass::where('id','=',$customclass->class_id)->first();
        $class->cur_number=$class->cur_number-1;
        $class->save();
        
        $customclass->delete();
        

        return redirect(url('/members'.'/'.$customer.'/class/create'))->with('success', 'Class Unenrolled');
    }
}