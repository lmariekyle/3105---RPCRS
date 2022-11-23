<?php

namespace Database\Seeders;


use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer=Customer::create([ 
            'status' => 'ACTIVE',
            'firstname' => 'David',
            'middlename' => 'Garcia',
            'lastname' => 'Martinez',
            'date_of_birth' => '2000-11-11',
            'phone_number' => '09189999999',
            'email' => 'martinez@gmail.com',
            'city' => 'Night',
            'province' => 'South California',
        ]);
        $customer=Customer::create([ 
            'status' => 'ACTIVE',
            'firstname' => 'Lucy',
            'middlename' => 'Lo',
            'lastname' => 'Yuki',
            'date_of_birth' => '2000-10-10',
            'phone_number' => '09178888888',
            'email' => 'yuki@gmail.com',
            'city' => 'Night',
            'province' => 'South California',
        ]);
        $customer=Customer::create([ 
            'status' => 'ACTIVE',
            'firstname' => 'Rebecca',
            'middlename' => 'Cazares',
            'lastname' => 'Kurosawa',
            'date_of_birth' => '2000-9-9',
            'phone_number' => '09167777777',
            'email' => 'kurosawa@gmail.com',
            'city' => 'Night',
            'province' => 'South California',
        ]);
        $customer=Customer::create([ 
            'status' => 'ACTIVE',
            'firstname' => 'Kiwi',
            'middlename' => 'Wong',
            'lastname' => 'Honda',
            'date_of_birth' => '2000-8-8',
            'phone_number' => '09156666666',
            'email' => 'honda@gmail.com',
            'city' => 'Night',
            'province' => 'South California',
        ]);
        $customer=Customer::create([ 
            'status' => 'ACTIVE',
            'firstname' => 'Maine',
            'middlename' => 'Stephens',
            'lastname' => 'Touchi',
            'date_of_birth' => '2000-7-7',
            'phone_number' => '09145555555',
            'email' => 'touchi@gmail.com',
            'city' => 'Night',
            'province' => 'South California',
        ]);
        $customer=Customer::create([ 
            'status' => 'ACTIVE',
            'firstname' => 'Falco',
            'middlename' => 'Mercer',
            'lastname' => 'Kase',
            'date_of_birth' => '2000-6-6',
            'phone_number' => '09134444444',
            'email' => 'kase@gmail.com',
            'city' => 'Night',
            'province' => 'South California',
        ]);
    }
}
