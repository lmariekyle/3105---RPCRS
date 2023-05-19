<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberTest extends TestCase
{
    /**
     * A basic feature test example.
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
}
