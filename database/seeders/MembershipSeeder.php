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
            'cur_number' => '0',
            'description' => 'HEHEHEHEHEHEHEHEHEH',
        ]);
        $membership=Membership::create([ 
            'name' => 'SILVER',
            'cur_number' => '0',
            'description' => 'HIHIHIHIHIHIHIHIHIHIHIH',
        ]);
        $membership=Membership::create([ 
            'name' => 'GOLD',
            'cur_number' => '0',
            'description' => 'HOHOHOHOHHHOHHOHOHOHHOHO',
        ]);
    }
}
