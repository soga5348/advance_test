<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;




class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 35; $i++) {
            Contact::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'email' => $faker->email,
                'postal_code' => $faker->postcode,
                'address' => $faker->address,
                'building' => $faker->optional()->buildingNumber,
                'message' => $faker->sentence
            ]);
    }
}
}