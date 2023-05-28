<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create Admin User
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => $this->getRandomDateTime(),
            'is_admin' => 1,
            'mobile' => 0,
        ]);

        // Create Normal Users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'password' => Hash::make('user'),
                'email_verified_at' => $this->getRandomDateTime(),
                'is_admin' => 0,
                'mobile' => $faker->phoneNumber
            ]);
        }
    }
    
    private function getRandomDateTime()
    {
        $faker = Faker::create();
        $dateTime = $faker->dateTimeThisDecade()->format('Y-m-d H:i:s');
        return $dateTime;
    }
}
