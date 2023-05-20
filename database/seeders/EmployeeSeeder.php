<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emp=User::create([ 
            'status' => 'ACTIVE',
            'firstname' => 'Kris',
            'middlename' => 'Falcasantos',
            'lastname' => 'Ponla',
            'date_of_birth' => '2000-10-10',
            'phone_number' => '09189999998',
            'email' => 'ponla@gmail.com',
            'password' => 'ponlaDaBest',
        ])->assignRole('Instructor');;
    }
}
