<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\CustomerMembership;
use App\Models\CustomerClass;
use App\Models\Membership;
use App\Models\GymClass;

class ClassEnCustomerController extends Controller
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
        $gymclass = GymClass::find($id);
        

        $customers = CustomerMembership::join('customers', 'customers.id', '=', 'customer_memberships.customer_id')
                                ->orderBy('customers.id',"asc")
                                ->paginate(10);

        foreach ($customers as $key) {
            $mem = Membership::where ('id','=',$key->membership_id)->first();
            $key->name=$mem->name;
        }

        $enrolled = CustomerClass::join('customers', 'customers.id', '=', 'customer_classes.customer_id')
                                    ->where('class_id', '=', $id)
                                    ->select('*','customer_classes.id as cc_id')
                                    ->orderBy('customer_id',"asc")
                                    ->paginate(10);
        
        foreach ($enrolled as $key) {
            
            $customships = CustomerMembership::where ('customer_id', '=', $key->customer_id)->first();
            $mem = Membership::where ('id','=',$customships->membership_id)->first();
            
            $key->name=$mem->name;
        }

            $data = [
                'gymclass' => $gymclass,
                'customers' => $customers,
                'enrolled' => $enrolled
            ];
            
            return view('gymclass.enroll')->with($data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $enrolled = CustomerClass::where(['class_id' => $id, 'customer_id' => $request->input('customer')])->first();
        
        if($enrolled == null){
            $cc = new CustomerClass;
            $cc->class_id = $request->input('class');
            $cc->customer_id = $request->input('customer');
            $cc->save();
            $class = GymClass::where('id','=',$request->input('class'))->first();
            $class->cur_number=$class->cur_number+1;
            $class->save();

            
            return redirect(url('/gymclass'.'/'.$id.'/enmem/create'))->with('success', 'Enrolled member to class');
        }else{
            
            return redirect(url('/gymclass'.'/'.$id.'/enmem/create'))->with('error', 'Cannot enroll member to the same class');
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
    public function destroy(Request $request)
    {
      
        $customclass = CustomerClass::findOrFail($request->customer_unenroll_id);
        $gymclass = $customclass->class_id;
        $class = GymClass::where('id','=',$customclass->class_id)->first();
        $class->cur_number=$class->cur_number-1;
        $class->save();
        
        $customclass->delete();

        return redirect(url('/gymclass'.'/'. $gymclass .'/enmem/create'))->with('success', 'Unenrolled member from class');
    }
}
