<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerMembership;
use App\Models\CustomerClass;
use App\Models\Membership;
use App\Models\GymClass;
use Carbon\Carbon;
use DB;
use League\CommonMark\Extension\CommonMark\Parser\Inline\EscapableParser;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    /*    
        
        $membership = Membership::all();
    */
        
    /*    $data = CustomerMembership::join('customers', 'customers.id', '=', 'customer_memberships.customer_id')
                                    ->join('memberships', 'memberships.id', '=', 'customer_memberships.membership_id')
                                    ->orderBy('customers.id',"asc")
                                    ->paginate(10);*/

        
        $data = Customer::orderBy('id','asc')->paginate(10);

        foreach ($data as $key) {
            $customships = CustomerMembership::where ('customer_id', '=', $key->id)->first();

            if($customships==null){
                $key->name="NONE";
            }else{
                $membership = Membership::where('id','=',$customships->membership_id)->first();
                $key->name = $membership->name;
            }
        }
       
       /* $data = [
            'customers' => $customers,
            'customships' => $customships,
            'membership' => $membership
        ];*/

        return view('members.index')->with('data',$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $memberships = Membership::all();
        return view('members.create')->with('memberships',$memberships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current = Carbon::now();
        $this->validate($request,[
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d|before:'.now()->subYears(13)->toDateString(),
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'email' => 'required|email',
            'city' => 'required',
            'province' => 'required',
        ]);

        $customer = new Customer;
        $customer->firstname = $request->input('firstname');
        $customer->middlename = $request->input('middlename');
        $customer->lastname = $request->input('lastname');
        $customer->date_of_birth = $request->input('date_of_birth');
        $customer->phone_number = $request->input('phone_number');
        $customer->email = $request->input('email');
        $customer->house_number = $request->input('house_number');
        $customer->street_name = $request->input('street_name');
        $customer->barangay = $request->input('barangay');
        $customer->municipality = $request->input('municipality');
        $customer->city = $request->input('city');
        $customer->province = $request->input('province');
        $customer->zip_code = $request->input('zip_code');

        $customer->save();
        
        $cc = new CustomerMembership;
        $cc->customer_id=$customer->id;
        $cc->membership_end_date = $current->addYear();
        $cc->membership_expires_in = $current;
        $cc->membership_id=$request->input('membership');
        $cc->save();

        $mem = Membership::where('id','=',$request->input('membership'))->first();
        $mem->cur_number=$mem->cur_number+1;
        $mem->save();

        return redirect('/members')->with('success', 'Member Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $customships = CustomerMembership::where ('customer_id', '=', $id)->first();
        if($customships==null){
            $customer->name="NONE";
            $customer->membership_start_date = "- - -";
            $customer->membership_end_date = "- - -";
        }else{
            $membership = Membership::where('id','=',$customships->membership_id)->first();
            $customer->name = $membership->name;
            $customer->membership_start_date = $customships->membership_start_date;
            $customer->membership_end_date = $customships->membership_end_date;
        }

        $classes = CustomerClass::join('customers', 'customer_classes.customer_id', '=', 'customers.id')
                    ->join('gym_classes', 'customer_classes.class_id', '=', 'gym_classes.id')
                    ->where ('customer_id', '=', $id)
                    ->select('*','customer_classes.id as cc_id')
                    ->orderBy('gym_classes.id',"asc")
                    ->paginate(10);


        $data = [
            'customer' => $customer,
            'classes' => $classes
        ];

        //return $classes;
        return view('members.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $customer = Customer::find($id);
        $customships = CustomerMembership::where ('customer_id', '=', $id)->first();
        $currplan=(object)array("name"=>" ");
            if($customships==null){
                $currplan->name="NONE";
            }else{
                $currplan = Membership::where ('id','=',$customships->membership_id)->first();
            }
        $memberships = Membership::all();
        $data = [
            'customer' => $customer,
            'currplan' => $currplan,
            'memberships' => $memberships
        ];

        return view('members.edit')->with($data);
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
        $current = Carbon::now();
        $this->validate($request,[
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d|before:'.now()->subYears(13)->toDateString(),
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'email' => 'required|email',
            'city' => 'required',
            'province' => 'required',
        ]);

        $customer = Customer::find($id);
        $customer->status = $request->input('status');
        $customer->firstname = $request->input('firstname');
        $customer->middlename = $request->input('middlename');
        $customer->lastname = $request->input('lastname');
        $customer->date_of_birth = $request->input('date_of_birth');
        $customer->phone_number = $request->input('phone_number');
        $customer->email = $request->input('email');
        $customer->house_number = $request->input('house_number');
        $customer->street_name = $request->input('street_name');
        $customer->barangay = $request->input('barangay');
        $customer->municipality = $request->input('municipality');
        $customer->city = $request->input('city');
        $customer->province = $request->input('province');
        $customer->zip_code = $request->input('zip_code');

        $customer->save();
        
        $cc = CustomerMembership::where ('customer_id', '=', $id)->first();

        
        if($cc==null) {
            $newmem = Membership::where('id','=',$request->input('membership'))->first();
            $newmem->cur_number=$newmem->cur_number+1;
            $newmem->save();

            
            $cc = new CustomerMembership;
            $cc->customer_id=$id;

            $cc->membership_end_date = $current->addYear();
            $cc->membership_expires_in = $current;
            $cc->membership_id=$request->input('membership');
            $cc->save();

        //if the membership plan has changed
        }else if ($request->input('membership')==null){
            $mem = Membership::where('id','=',$cc->membership_id)->first();
            $mem->cur_number=$mem->cur_number-1;
            $mem->save();
            
            $newmem = Membership::where('id','=',$request->input('membership'))->first();
            $newmem->cur_number=$newmem->cur_number+1;
            $newmem->save();

            $cc->membership_id=$request->input('membership');
            $cc->save();
        
            //if the membership plan has not changed
        }else {
            $cc->save();
        
        }
        

        return redirect('/members')->with('success', 'Member Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $customer = Customer::find($request->customer_delete_id);
        $customships = CustomerMembership::where ('customer_id', '=', $request->customer_delete_id)->first();

        if($customships==null){
            
        }else{
            $mem = Membership::where ('id','=',$customships->membership_id)->first();
            $mem->cur_number=$mem->cur_number-1;
            $mem->save();

            $customships->delete();
        }

        $customclass = CustomerClass::where('customer_id', '=', $customer->id);

        foreach ($customclass as $key) {
            $class = GymClass::where('id','=',$key->class_id)->first();
            $class->cur_number=$class->cur_number-1;
            $class->save();
            
        }

        $customclass->delete();
        $customer->delete();

        return redirect('/members')->with('success', 'Member Deleted Successfully');
    }
}
