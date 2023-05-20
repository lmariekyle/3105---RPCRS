<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Spatie\Permission\Models\Role;

class EmployeeTest extends TestCase
{
    use WithFaker;
    
    public function testIndex() {
        $response = $this->get('/employees');
        $response->assertStatus(200); 
    }

    public function testCreateMethod() {
        $user = [
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->lastName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'phone_number' => '00000000000',
            'password' => $this->faker->password
        ];
        $response = $this->get(route('employees.create', ['employee' => $user]));
        $response->assertStatus(200); 
    }

    public function testStoreMethod() {
        $data = [
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->lastName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'phone_number' => '00000000000',
            'password' => $this->faker->password
        ];

        $response = $this->post(route('employees.store', $data));
        $response->assertRedirect('/employees');
        $response->assertSessionHas('success', 'Employee added successfully');
    }

    public function testShow() {
        $id = 2;
        $response = $this->get(route('employees.show', $id));
        $response->assertStatus(200); 
    }
    public function testEdit() {
        $id = 2;
        $response = $this->get(route('employees.edit', $id));
        $response->assertStatus(200); 
    }
    public function testUpdateMethod() {
        $id = 2;
        $employee = User::find($id);
        $data = [
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->lastName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'phone_number' => '00000000000',
            'status' => 'ACTIVE'
        ];

        $response = $this->put(route('employees.update', ['employee' => $employee]), $data);
        $response->assertRedirect('/employees');
        $response->assertSessionHas('success', 'Employee Updated successfully');
    }

    public function testViewEmployee() {
        $id = 2;
        $response = $this->get(route('employees.viewEmployee', $id));
        $response->assertStatus(200); 
    }

    public function testAssignRole() {
        $id = 2;
        $role = 'SuperAdmin';
        $employee = User::find($id);

        $response = $this->post(route('employees.roles', ['employee' => $employee]), ['role' => $role]);
        $response->assertRedirect('/');
        $response->assertSessionHas('message','Role Added');
    }

    public function testRemoveRole() {
        $id = 2;
        $role = 'Admin';
        $employee = User::find($id);
        $roles = Role::where('id', '>=', 1)->first();

        $response = $this->delete(route('employees.roles.remove', ['employee' => $employee, 'role' => $roles]));
        $response->assertRedirect('/');
        $response->assertSessionHas('message','Role Removed');
    }

    public function testDestroyMethod() {
        $userId = 3;
        $response = $this->delete(route('employees.destroy', $userId), ['employee' => $userId]);
        $response->assertRedirect('/employees');
        $response->assertSessionHas('success', 'Employee Deleted successfully');
    }
}
