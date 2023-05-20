<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\GymClass;
use App\Models\User;
use App\Models\StaffDetails;

class StaffDetailsTest extends TestCase
{
    use WithFaker;

    public function testStoreNew() {
        $request = [
            'employee_id' => 2, 
            'class_id' => 1
        ];

        $response = $this->post(route('staffdetails.store', $request));
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Instructor added successfully');
    }

    public function testStoreExisting() {
        $request = [
            'employee_id' => 2, 
            'class_id' => 1
        ];

        $response = $this->post(route('staffdetails.store', $request));
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Cannot add instructor to the same class');
    }

    public function testShow() {
        $id = 1;
        $gymclass = GymClass::find($id);
        $response = $this->get(route('staffdetails.show', $id));
        $response->assertStatus(200); 
        $response->assertSuccessful();

        // Assert that the view contains the gym class, employees, gym details, and instructors
        $response->assertViewHas('gymclass', $gymclass);
        $response->assertViewHas('employees', User::role('Instructor')->get());
        $response->assertViewHas('gymdetails', StaffDetails::where('class_id', '=', $id)->get());
        ob_end_clean();
    }

    public function testDestroy() {
        $id = 2;
        $response = $this->delete(route('staffdetails.destroy', $id));
        $response->assertRedirect(); 
        $response->assertSessionHas('success', 'Instructor Deleted Successfully');
    }

}
