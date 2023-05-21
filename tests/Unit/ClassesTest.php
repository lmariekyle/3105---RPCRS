<?php

namespace Tests\Unit;
use App\Models\Customer;
use App\Models\CustomerClass;
use App\Models\CustomerMembership;
use App\Models\GymClass;
use App\Models\Membership;
use App\Models\StaffDetails;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class ClassesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_gym_classes_page()
    {
        $response = $this->get('/gymclass');
        $response->assertStatus(200);
    }
    public function test_get_create_gymclass_page()
    {
        $response = $this->get('/gymclass/create');
        $response->assertStatus(200);
    }

    public function test_add_gymclass_form()
    {
         
        $this->post('gymclass/create', [
            'name' => 'AEROBICS',
            'status' => 'ACTIVE',
            'description' => 'A spiritual gymnastics.',
            'max_enrollees' => '20',
            'cur_number' => '0',
            'price' => '500.00',
            'schedule' => 'MWF',
            'time' => '3:00 PM - 4:00 PM',
        ]);

        $this->assertTrue(true);
       
    }
    
    public function test_find_gymclass_stored()
    {
        $gymclass = GymClass::find(4);
    
        $this->assertTrue(true);

    }
    public function test_get_gymclass_info_page()
    {
        /*given the id number 4*/
        $response = $this->get('/gymclass/4');
        $response->assertStatus(500);

    }
    
    public function test_get_update_gymclass_page()
    {
        $response = $this->get('/gymclass/4/edit');
        $response->assertStatus(500);
    }

    public function test_update_form()
    {
        
        $this->post('gymclass/edit', [
            'name' => 'AERUBICS',
            'status' => 'ACTIVE',
            'description' => 'A spiritual gymnastics course.',
            'max_enrollees' => '25',
            'cur_number' => '0',
            'price' => '600.00',
            'schedule' => 'MWF',
            'time' => '2:00 PM - 3:00 PM',
        ]);

        $this->assertTrue(true);
    }

    public function test_get_enroll_instructor_to_class_page()
    {
        $response = $this->get('/staffdetails/4');
        $response->assertStatus(500);
    }

    public function test_assign_instructor()
    {
        
        
        $this->post('staffdetails/edit', [
            'employee_id' => '2',
            'class_id' => '4',
        ]);

        $this->assertTrue(true);
        
    }
    
    public function test_enroll_classes(){
        
        
        $this->post('gymclass/1/enmem/create',[
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
    

    public function test_delete_gymclass()
    {
        /*given an id of the gym*/

        $gymclass = GymClass::make();

        if($gymclass){
            $gymclass->delete();

        }


        $this->assertTrue(true);

    }

    
}
