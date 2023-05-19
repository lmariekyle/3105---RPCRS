<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membership=Membership::create([ 
            'name' => 'BRONZE',
            'status' => 'ACTIVE',
            'cur_number' => '2',
            'description' => 'A 1-year membership that has access to the gym floor',
            'price' => '350',
            'duration' => '1 YEAR',
        ]);
        $membership=Membership::create([ 
            'name' => 'SILVER',
            'status' => 'ACTIVE',
            'cur_number' => '2',
            'description' => 'A 1-year membership that has access to the gym floor and free classes',
            'price' => '500',
            'duration' => '1 YEAR',
        ]);
        $membership=Membership::create([ 
            'name' => 'GOLD',
            'status' => 'ACTIVE',
            'cur_number' => '1', 
            'description' => 'A 1-year membership that has access to the gym floor, free classes, and a free private instructor',
            'price' => '800',
            'duration' => '1 YEAR',
        ]);
    }
}
