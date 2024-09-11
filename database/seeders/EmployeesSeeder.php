<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1,10) as $index){
            Employee::create([
                'name' => $faker->name,
                'gender' => $faker->randomElement(['l','p']),
                'email' => $faker->email,
                'address' => $faker->address,
                'position_id' => $faker->numberBetween(1,10), 
                'status' => $faker->numberBetween(1,3)
            ]);
        }
    }
}
