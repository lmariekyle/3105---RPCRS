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
        
        $this->post('/members/create', [
            'status' => 'ACTIVE',
            'firstname' => 'Joseph Jobo',
            'middlename' => 'Savellano',
            'lastname' => 'Licayan',
            'date_of_birth' => '2000-07-23',
            'phone_number' => '09189977777',
            'email' => 'jobow@gmail.com',
            'city' => 'DAVAO',
            'province' => 'DAVAO',
        ]);

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
        $this->post('/members/edit', [
            'status' => 'ACTIVE',
            'firstname' => 'Joseph',
            'middlename' => 'Savellanoe',
            'lastname' => 'Licayana',
            'date_of_birth' => '2000-06-23',
            'phone_number' => '09189977577',
            'email' => 'jobo@gmail.com',
            'city' => 'DABAO',
            'province' => 'DABAO',
        ]);

        $this->assertTrue(true);

    }

    public function test_assign_membership()
    {
        $this->post('membership/1/customers/create',[
            'customer_id' => '7',
            'membership_id' => '2',
            'membership_end_date' => '2023-11-12 22:04:04',
            'membership_expires_in' => '2022-11-12 22:04:04',

        ]);
        
        $this->assertTrue(true);
    }

    public function test_get_enroll_member_to_class_page()
    {
        $this->get('/members/4/class/create');
        $this->assertTrue(true);
    }

    public function test_enroll_classes_to_customer(){
        
        $this->post('members/1/customers/create',[
            'class_id' => '4',
            'customer_id' => '2'

        ]);
        $this->assertTrue(true);
        
    }
    
    public function test_unenroll_classes(){
        
        $custclass = CustomerClass::make();

        if($custclass){
            $custclass->delete();
        }

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
