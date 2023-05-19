<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\CustomerMembership;
use App\Models\CustomerClass;
use App\Models\Membership;
use App\Models\GymClass;

class ClassCustomerController extends Controller
{

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

        return redirect(url('/gymclass'.'/'. $gymclass))->with('success', 'Unenrolled user from class');
    }
}
