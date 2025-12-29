<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;              
use Illuminate\Support\Facades\Hash;

class WaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Dewi Wali',
            'email' => 'dewi@gmail.com',
            'phone' => '88888888',
            'role' => 'wali',
            'password' => Hash::make('wali123'),
        ]);
    }
}
