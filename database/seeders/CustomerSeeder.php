<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kavithma',
                'email' => 'kavithma@gmail.com',
                'address' => 'Galle',
                'salary' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kamal',
                'email' => 'kamal@gmail.com',
                'address' => 'Matara',
                'salary' => 56000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nimal',
                'email' => 'nimal@gmail.com',
                'address' => 'Colombo',
                'salary' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($data as $customer) {
            Customer::updateOrCreate($customer);
        }
    }
}
