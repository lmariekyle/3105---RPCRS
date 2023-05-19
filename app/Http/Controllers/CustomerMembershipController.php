<?php

namespace App\Http\Controllers;

use App\Models\CustomerMembership;
use App\Models\Membership;
use Illuminate\Http\Request;

class CustomerMembershipController extends Controller
{

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
        

        return redirect(url('/membership'.'/'.$customer))->with('success', 'Unenrolled user from membership');
    }
}
