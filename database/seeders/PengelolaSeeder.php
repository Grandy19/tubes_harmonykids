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
            ['name' => 'Pengelola 1',  'email' => 'pengelola1@test.com'],
            ['name' => 'Pengelola 2',  'email' => 'pengelola2@test.com'],
            ['name' => 'Pengelola 3',  'email' => 'pengelola3@test.com'],
            ['name' => 'Pengelola 4',  'email' => 'pengelola4@test.com'],
            ['name' => 'Pengelola 5',  'email' => 'pengelola5@test.com'],
            ['name' => 'Pengelola 6',  'email' => 'pengelola6@test.com'],
            ['name' => 'Pengelola 7',  'email' => 'pengelola7@test.com'],
            ['name' => 'Pengelola 8',  'email' => 'pengelola8@test.com'],
            ['name' => 'Pengelola 9',  'email' => 'pengelola9@test.com'],
            ['name' => 'Pengelola 10', 'email' => 'pengelola10@test.com'],
            ['name' => 'Pengelola 11', 'email' => 'pengelola11@test.com'],
            ['name' => 'Pengelola 12', 'email' => 'pengelola12@test.com'],
        ];

        foreach ($pengelolas as $item) {
            User::firstOrCreate(
                ['email' => $item['email']],
                [
                    'name'     => $item['name'],
                    'role'     => 'pengelola',
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
