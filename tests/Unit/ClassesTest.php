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
        $temp = 'AM';
        $gymclass = new GymClass;
        $gymclass->name =  strtoupper('AEROBICS');
        $gymclass->price = '500';
        $gymclass->schedule = 'MWF';
        $gymclass->description = 'gymnastics in the air';
        $gymclass->max_enrollees = '20';
        $gymclass->cur_number = 0;
        $apm='AM';
        $end=str_split('8:00',2);

        if(strcmp($end[0],"12")==0){
            if($temp=='AM'){
                $apm="PM";
            }else if($temp=='PM'){
                $apm="AM";
            }
        }

        $time='7:00' . ' ' . $temp . ' - ' . '8:00' . ' ' . $apm;
        $gymclass->time = $time;

        $gymclass->save();

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
        $response->assertStatus(200);

    }
    
    public function test_get_update_gymclass_page()
    {
        $response = $this->get('/gymclass/4/edit');
        $response->assertStatus(200);
    }

    public function test_update_form()
    {
        $gymclass = GymClass::find(4);

        $temp = 'AM';
        $gymclass->name = strtoupper('AEROUBICS');
        $gymclass->price = '600';
        $gymclass->schedule = 'MTHF';
        $gymclass->description = 'Gymnastics while in the air';
        $gymclass->max_enrollees = '25';
        $gymclass->cur_number = 0;
        $apm='AM';
        $end=str_split('7:00',2);

        if(strcmp($end[0],"12")==0){
            if($temp=='AM'){
                $apm="PM";
            }else if($temp=='PM'){
                $apm="AM";
            }
        }

        $time='6:00' . ' ' . $temp . ' - ' . '7:00' . ' ' . $apm;
        $gymclass->time = $time;

        $gymclass->save();

        $this->assertTrue(true);
    }

       public function test_get_enroll_instructor_to_class_page()
    {
        $response = $this->get('/staffdetails/4');
        $response->assertStatus(200);
    }

    public function test_assign_instructor(){
               
        $emp=User::find(2);
        $cc = new StaffDetails;
        $cc->employee_id = 2;
        $cc->class_id = 4;
        if($emp::role('Instructor')){
            $cc->save();
        }
        
        $this->assertTrue(true);
        
    }
    
    public function test_enroll_classes(){
        
        $enrolled = CustomerClass::where(['class_id' => 4, 'customer_id' => 6])->first();
        
        if($enrolled == null){
            $class = GymClass::where('id','=',4)->first();

            if($class->cur_number<$class->max_enrollees){
                
                $cc = new CustomerClass;

                $cc->class_id = 4;
                $cc->customer_id = 6;
                $cc->save();

                $class->cur_number=$class->cur_number+1;
                $class->save();

            }
            
        }

        $this->assertTrue(true);
        
    }
    public function test_unenroll_classes(){
        
        $customclass = CustomerClass::findOrFail(1);
        $class = GymClass::where('id','=',4)->first();
        $class->cur_number=$class->cur_number-1;
        $class->save();
        
        $customclass->delete();

        $this->assertTrue(true);
        
    }
    

    public function test_delete_member()
    {
        /*given an id of the gym*/

        $gymclass = GymClass::find(4);

        $customclass = CustomerClass::where('class_id', '=', 4);
        foreach ($customclass as $key ) {
            $key->delete();
        }

        $gymclass->delete();

        $this->assertTrue(true);

    }

    
}
