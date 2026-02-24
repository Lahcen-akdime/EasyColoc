<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::factory()->create([
            'name' => 'Lahcen',
            'email' => 'akdiml309@gmail.com',
            'password' => 'akdiml309@gmail.com',
            'role' => 'admin' ,
        ]);
    }
}