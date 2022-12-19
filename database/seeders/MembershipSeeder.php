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
            'cur_number' => '2',
            'description' => 'A 1-year membership that has access to the gym floor',
        ]);
        $membership=Membership::create([ 
            'name' => 'SILVER',
            'cur_number' => '2',
            'description' => 'A 1-year membership that has access to the gym floor and free classes',
        ]);
        $membership=Membership::create([ 
            'name' => 'GOLD',
            'cur_number' => '1',
            'description' => 'A 1-year membership that has access to the gym floor, free classes, and a free private instructor',
        ]);
    }
}
