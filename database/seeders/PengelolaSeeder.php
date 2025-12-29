<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PengelolaSeeder extends Seeder
{
    public function run(): void
    {
        $pengelolas = [
            [
                'name' => 'Pengelola TK Ceria',
                'email' => 'pengelola1@test.com',
            ],
            [
                'name' => 'Pengelola TK Pintar',
                'email' => 'pengelola2@test.com',
            ],
            [
                'name' => 'Pengelola Daycare Bahagia',
                'email' => 'pengelola3@test.com',
            ],
            [
                'name' => 'Pengelola Daycare Cerah',
                'email' => 'pengelola4@test.com',
            ],
        ];

        foreach ($pengelolas as $item) {
            User::firstOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['name'],
                    'phone' => '08123456789',
                    'role' => 'pengelola',
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
