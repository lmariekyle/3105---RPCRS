<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerMembership;
use App\Models\CustomerClass;
use App\Models\Membership;
use App\Models\GymClass;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;

class CustEnMembershipController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $membership = Membership::find($id);
        

        $customers = Customer::orderBy('customers.id',"asc")
                                ->paginate(10);

        foreach ($customers as $key) {
            $def = CustomerMembership::where('customer_id','=',$key->id)->first();

            if($def==NULL){
            
                $key->name="NONE";
            }else{
            
                $mem = Membership::where ('id','=',$def->membership_id)->first();
                $key->name=$mem->name;
            }
        }

        $enrolled = CustomerMembership::join('customers', 'customers.id', '=', 'customer_memberships.customer_id')
                                    ->where('membership_id', '=', $id)
                                    ->select('*','customer_memberships.id as cc_id')
                                    ->orderBy('customer_id',"asc")
                                    ->paginate(10);
        

            $data = [
                'membership' => $membership,
                'customers' => $customers,
                'enrolled' => $enrolled
            ];
            
            return view('membership.enroll')->with($data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {   
        $daan = CustomerMembership::where('customer_id','=',$request->input('customer'))->first();
        $enrolled = CustomerMembership::where(['membership_id' => $id, 'customer_id' => $request->input('customer')])->first();

        if($daan==NULL){
        
            if($enrolled == null){
                
                $current = Carbon::now();
                $mem = Membership::where('id','=',$request->input('membership'))->first();
                    
                $cc = new CustomerMembership;
            
                $mem->cur_number=$mem->cur_number+1;

                $dur=str_split($mem->duration,1);

                    if(strcmp($dur[0],"1")==0){
                        if(strcmp($dur[2],"Y")==0){
                            $cc->membership_end_date = $current->addYear();
                        }else if(strcmp($dur[2],"M")==0){
                            $cc->membership_end_date = $current->addMonth();
                        }else{ 
                            $val=str_split($mem->duration,2);
                            $cc->membership_end_date = $current->addMonths((int)$val[0]);
                        }
                        
                    }else{
                        $val = (int)$dur[0];
                        $cc->membership_end_date = $current->addMonths($val);
                    }

                $cc->membership_expires_in = $current;
                $cc->membership_id=$request->input('membership');
                $cc->customer_id = $request->input('customer');

                $cc->save();
                $mem->save();
                
                    
                return redirect(url('/membership'.'/'.$id.'/encust/create'))->with('success', 'Enrolled member to membership');
            }else{
                
                return redirect(url('/membership'.'/'.$id.'/encust/create'))->with('error', 'Cannot enroll member to the same membership');
            }
        }else if($enrolled != null){   
            return redirect(url('/membership'.'/'.$id.'/encust/create'))->with('error', 'Cannot enroll member to the same membership');
        }else{
            return redirect(url('/membership'.'/'.$id.'/encust/create'))->with('error', 'Cannot enroll member to the another membership');
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
      
        $custmem = CustomerMembership::findOrFail($request->customer_unenroll_id);
        $customer = $custmem->membership_id;
        $membership = Membership::where('id','=',$custmem->membership_id)->first();
        $membership->cur_number=$membership->cur_number-1;
        $membership->save();
        
        $custmem->delete();
        

        return redirect(url('/membership'.'/'.$customer. '/encust/create'))->with('success', 'Unenrolled user from membership');
    }
}
