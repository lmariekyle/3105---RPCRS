<?php

namespace Database\Seeders;

use App\Models\GymClass;
use Illuminate\Database\Seeder;

class GymClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $gymclass=GymClass::create([ 
            'name' => 'YOGA',
            'status' => 'ACTIVE',
            'description' => 'A spiritual discipline based on an extremely subtle science, which focuses on bringing harmony between mind and body.',
            'max_enrollees' => '20',
            'cur_number' => '0',
            'price' => '500.00',
            'schedule' => 'MWF',
            'time' => '8:00 AM - 9:00 AM',
        ]);
        $gymclass=GymClass::create([ 
            'name' => 'BOXING',
            'status' => 'ACTIVE',
            'description' => 'A combat sport in which two people, usually wearing protective gloves and other protective equipment such as hand wraps and mouthguards, throw punches at each other for a predetermined amount of time in a boxing ring',
            'max_enrollees' => '20',
            'cur_number' => '0',
            'price' => '500.00',
            'schedule' => 'WEEKDAYS',
            'time' => '6:00 AM - 7:00 AM',
        ]);
        $gymclass=GymClass::create([ 
            'name' => 'SWIMMING',
            'status' => 'ACTIVE',
            'description' => 'An individual or team racing sport that requires the use of the entire body to move through water',
            'max_enrollees' => '20',
            'cur_number' => '0',
            'price' => '500.00',
            'schedule' => 'TTHS',
            'time' => '10:00 AM - 11:00 AM',
        ]);
    }
}
