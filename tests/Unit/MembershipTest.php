<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\CustomerClass;
use App\Models\Membership;

class MembershipTest extends TestCase
{
    use WithFaker;

    public function testIndex() {
        $response = $this->get(route('membership.index'));
        $response->assertStatus(200);
        $response->assertViewIs('membership.index');
    }

    public function testCreate() {
        $response = $this->get(route('membership.create'));
        $response->assertStatus(200);
        $response->assertViewIs('membership.create');
    }

    public function testStore() {
        $data = [
            'name' => $this->faker->name, 
            'price' => '1.00', 
            'months' => '1', 
            'description' => 'test'
        ];

        $response = $this->post(route('membership.store', $data));
        $response->assertRedirect('/membership');
        $response->assertSessionHas('success', 'Gym Membership Added Successfully');
    }

    public function testStoreYesr() {
        $data = [
            'name' => $this->faker->name, 
            'price' => '1.00', 
            'months' => '12', 
            'description' => 'test'
        ];

        $response = $this->post(route('membership.store', $data));
        $response->assertRedirect('/membership');
        $response->assertSessionHas('success', 'Gym Membership Added Successfully');
    }

    public function testShow() {
        $id = 1;
        $response = $this->get(route('membership.show', ['membership' => $id]));
        $response->assertStatus(200);
        $response->assertViewIs('membership.show');
    }

    public function testEdit() {
        $id = 1;
        $response = $this->get(route('membership.edit', ['membership' => $id]));
        $response->assertStatus(200);
        $data = Membership::find($id);
        $response->assertViewIs('membership.edit');
        $response->assertViewHas('membership', $data);
    }

    public function testUpdate() {
        $id = 1;
        $data = [
            'name' => $this->faker->name, 
            'price' => '1.00', 
            'months' => '1', 
            'description' => 'test',
            'status' => 'ACTIVE'
        ];

        $response = $this->put(route('membership.update', ['membership' => $id]), $data);
        $response->assertRedirect('/membership');
        $response->assertSessionHas('success', 'Gym Membership Updated Successfully');
    }

    public function testUpdateYear() {
        $id = 1;
        $data = [
            'name' => $this->faker->name, 
            'price' => '1.00', 
            'months' => '12', 
            'description' => 'test',
            'status' => 'ACTIVE'
        ];

        $response = $this->put(route('membership.update', ['membership' => $id]), $data);
        $response->assertRedirect('/membership');
        $response->assertSessionHas('success', 'Gym Membership Updated Successfully');
    }

    public function testDestroy() {
        $membership = 2;

        $response = $this->delete(route('membership.destroy', ['membership' => $membership]));
        $response->assertRedirect('/membership');
        $response->assertSessionHas('success', 'Gym Membership Deleted Successfully');
    }
}
