<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerMembership;
use App\Models\CustomerClass;
use App\Models\Membership;
use App\Models\GymClass;

class CustomerClassController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $customships = CustomerMembership::where ('customer_id', '=', $id)->first();
        if($customships==null){
            return redirect(url('/members'.'/'.$id))->with('error', 'Cannot Enroll without Membership Plan');
        }else{
            
            $customer = Customer::find($id);
            $classes = GymClass::paginate(10);
            $membership = Membership::where ('id','=',$customships->membership_id)->first();
            $enrolled = CustomerClass::join('customers', 'customers.id', '=', 'customer_classes.customer_id')
                        ->join('gym_classes', 'gym_classes.id', '=', 'customer_classes.class_id')
                        ->where ('customer_id', '=', $id)
                        ->select('*','customer_classes.id as cc_id')
                        ->orderBy('gym_classes.id',"asc")
                        ->paginate(10);

            $data = [
                'customer' => $customer,
                'membership' => $membership,
                'classes' => $classes,
                'enrolled' => $enrolled
            ];
            
            return view('members.enroll')->with($data);
        }

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)    
    {
        $enrolled = CustomerClass::where (['customer_id', '=', $id],['class_id', '=', $request->input('class')]);
        
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
        $customclass = CustomerClass::findOrFail($request->customer_unenroll_id);
        $customer = $customclass->customer_id;
        $class = GymClass::where('id','=',$customclass->class_id)->first();
        $class->cur_number=$class->cur_number-1;
        $class->save();
        
        $customclass->delete();
        

        return redirect(url('/members'.'/'.$customer))->with('success', 'Unenrolled user from class');
    }
}
