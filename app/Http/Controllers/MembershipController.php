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

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Membership::orderBy('id','asc')->paginate(10);
        return view('membership.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membership.create');
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
            'price' => 'required',
            'months' => 'required',
            'description' => 'required',
        ]);

        $membership = new Membership;
        $membership->name =  strtoupper($request->input('name'));
        $membership->description = $request->input('description');
        $membership->price = $request->input('price');
        $membership->cur_number = 0;

        $mon=str_split($request->input('months'),2);

        if(strcmp($mon[0],"12")==0){
            $membership->duration="1 YEAR";
        }else{
            $membership->duration=$request->input('months');
        }

        $membership->save();
        

        return redirect('/membership')->with('success', 'Gym Membership Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $membership = Membership::find($id);
        //$emp = StaffDetails::where ('customer_id', '=', $id)->first();
        //$emp = Membership::where ('id','=',$customships->membership_id)->first();

        $customships = CustomerMembership::join('customers', 'customers.id', '=', 'customer_memberships.customer_id')
                                    ->where('membership_id', '=', $id)
                                    ->select('*','customer_memberships.id as cc_id')
                                    ->orderBy('customer_id',"asc")
                                    ->paginate(10);


        $data = [
            'membership' => $membership,
            'customer' => $customships,
        ];

        //return $customclass;
        return view('membership.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $data = Membership::find($id);

        return view('membership.edit')->with('membership',$data);
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
            'price' => 'required',
            'months' => 'required',
            'description' => 'required',
        ]);

        $membership = Membership::find($id);
        $membership->name =  strtoupper($request->input('name'));
        $membership->status = $request->input('status');
        $membership->description = $request->input('description');
        $membership->price = $request->input('price');
        $membership->cur_number = 0;

        $mon=str_split($request->input('months'),2);

        if(strcmp($mon[0],"12")==0){
            $membership->duration="1 YEAR";
        }else{
            $membership->duration=$request->input('months');
        }

        $membership->save();
        

        return redirect('/membership')->with('success', 'Gym Membership Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $membership = Membership::find($request->membership_delete_id);

        $custmem = CustomerMembership::where('membership_id', '=', $request->membership_delete_id);
        foreach ($custmem as $key ) {
            
            $memclass = CustomerClass::where('customer_id', '=', $key->customer_id);
            foreach ($memclass as $flag ) {
                $flag->delete();
            }
                
            $key->delete();
        }

        $membership->delete();

        return redirect('/membership')->with('success', 'Gym Membership Deleted Successfully');
    }
}
