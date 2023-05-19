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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)    
    {
        
        $enrolled = CustomerClass::where(['customer_id' => $id, 'class_id' => $request->input('class')])->first();
        
        if($enrolled == null){
            
            $class = GymClass::where('id','=',$request->input('class'))->first();

            if($class->cur_number<$class->max_enrollees){

                $cc = new CustomerClass;

                $cc->class_id = $request->input('class');
                $cc->customer_id = $request->input('customer');
                $cc->save();

                $class->cur_number=$class->cur_number+1;
                $class->save();
                
                return redirect(url('/members'.'/'.$id.'/class/create'))->with('success', 'Enrolled member to class');
            }else{
                return redirect(url('/members'.'/'.$id.'/class/create'))->with('error', 'Cannot enroll member to class with max capacity');
            }
            
           
        }else{
            
            return redirect(url('/members'.'/'.$id.'/class/create'))->with('error', 'Cannot enroll member to the same class');
        }
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
        

        return redirect->back()->with('success', 'Unenrolled member from class');
    }
}