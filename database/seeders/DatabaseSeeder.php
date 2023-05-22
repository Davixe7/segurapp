<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'David',
            'email' => 'david@segurapp.com',
            'password'=> bcrypt(123456)
        ]);
        \App\Models\Residence::factory(10)->create(['user_id'=>1])
        ->each(function($residence){
            for ($i=100; $i < 200; $i++) {
                Apartment::create([
                    'name'         => $i,
                    'residence_id' => 1,
                ]);
            }
        });
    }
}
