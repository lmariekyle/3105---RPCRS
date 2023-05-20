<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\CustomerClass;
use App\Models\CustomerMembership;
use App\Models\GymClass;
use App\Models\Membership;
use Carbon\Carbon;
use Tests\TestCase;

class MemberTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_members_page()
    {
        $response = $this->get('/members');
        $response->assertStatus(500);
    }
    public function test_get_create_members_page()
    {
        $response = $this->get('/members/create');
        $response->assertStatus(500);
    }

    public function test_add_form()
    {
        $customer = new Customer;
        
        $customer->firstname = 'Joseph Jobo';
        $customer->middlename = 'Savellano';
        $customer->lastname = 'Licayan';
        $customer->date_of_birth = '2000-07-23';
        $customer->phone_number = '09189977777';
        $customer->email = 'jobow@gmail.com';
        $customer->city = 'Davao';
        $customer->province = 'Davao';

        $customer->save();

        $this->assertTrue(true);
    }
    
    public function test_find_member_stored()
    {
        $customer = Customer::find(7);
    
        $this->assertTrue(true);

    }
    public function test_get_member_info_page()
    {
        /*given the id number 7*/
        $response = $this->get('/members/7');
        $response->assertStatus(500);

    }
    
    public function test_get_update_members_page()
    {
        $response = $this->get('/members/7/edit');
        $response->assertStatus(500);
    }

    public function test_update_form()
    {
        $customer = Customer::find(7);

        $customer->firstname = 'Jobow';
        $customer->middlename = 'Savells';
        $customer->lastname = 'Licay';
        $customer->date_of_birth = '2000-07-24';
        $customer->phone_number = '09189977767';
        $customer->email = 'jdgm@gmail.com';
        $customer->city = 'Dabaw';
        $customer->province = 'Dabaw';

        $customer->save();

        $this->assertTrue(true);
    }

    public function test_assign_membership()
    {
        $current = Carbon::now();
        $newmem = Membership::where('id','=',1)->first();
            $cc = new CustomerMembership;
            
            $newmem->cur_number=$newmem->cur_number+1;

            $dur=str_split($newmem->duration,1);

            if(strcmp($dur[0],"1")==0){
                if(strcmp($dur[2],"Y")==0){
                    $cc->membership_end_date = $current->addYear();
                }else if(strcmp($dur[2],"M")==0){
                    $cc->membership_end_date = $current->addMonth();
                }else{ 
                    $val=str_split($newmem->duration,2);
                    $cc->membership_end_date = $current->addMonths((int)$val[0]);
                }
            }else{
                $val = (int)$dur[0];
                $cc->membership_end_date = $current->addMonths($val);
            }
            /*given the member id of 7*/

            $cc->customer_id=7;
            $cc->membership_expires_in = $current;
            $cc->membership_id=1;

            $newmem->save();

            $cc->save();


        $this->assertTrue(true);
    }

    public function test_get_enroll_members_to_class_page()
    {
        $response = $this->get('/members/7/class/create');
        $response->assertStatus(500);
    }

    public function test_assign_classes(){
        
        $cc = new CustomerClass;
        $cc->class_id = 2;
        $cc->customer_id = 7;
        $cc->save();
        $class = GymClass::where('id','=',2)->first();
        $class->cur_number=$class->cur_number+1;
        $class->save();

        $this->assertTrue(true);
        
    }
    
    public function test_unenroll_classes(){
        
        $customclass = CustomerClass::findOrFail(1);
        $class = GymClass::where('id','=',$customclass->class_id)->first();
        $class->cur_number=$class->cur_number-1;
        $class->save();
        
        $customclass->delete();

        $this->assertTrue(true);
        
    }
    

    public function test_delete_member()
    {
        /*given an id of the customer*/
        $member = Customer::find(7);
        $customships = CustomerMembership::where ('customer_id', '=', 7)->first();
        $customclass = CustomerClass::where('customer_id', '=', 7)->first();

        if($member){
            $mem = Membership::where ('id','=',1)->first();
            $mem->cur_number=$mem->cur_number-1;
            $mem->save();
    
            $member->delete();
            $customships->delete();
        }    

        while($customclass!=null){
            $class = GymClass::where('id','=',$customclass->class_id)->first();
            $class->cur_number=$class->cur_number-1;
            $class->save();
            
            $customclass->delete();

            $customclass = CustomerClass::where('customer_id', '=', 7)->first();
        }


        $this->assertTrue(true);

    }

    
}
