<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Instansi\Models\Instansi;
use App\Modules\Instansi\Models\InstansiProfile;
use App\Modules\Instansi\Models\InstansiGallery;
use App\Models\User;

class DummyInstansiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil 4 pengelola (1 pengelola = 1 instansi)
        $pengelolas = User::where('role', 'pengelola')->take(4)->get();

        if ($pengelolas->count() < 4) {
            $this->command->warn('Seeder dibatalkan: jumlah pengelola kurang dari 4.');
            return;
        }

        $data = [
            [
                'nama' => 'TK Ceria Bandung',
                'jenis' => 'TK/PG',
                'lokasi' => 'Bandung',
                'biaya' => 1200000,
                'bakat' => 'Seni & Kreativitas',
            ],
            [
                'nama' => 'TK Pintar Surabaya',
                'jenis' => 'TK/PG',
                'lokasi' => 'Surabaya',
                'biaya' => 1500000,
                'bakat' => 'Akademik Dasar',
            ],
            [
                'nama' => 'Daycare Bahagia Bekasi',
                'jenis' => 'Daycare',
                'lokasi' => 'Bekasi',
                'biaya' => 2200000,
                'bakat' => 'Sosial & Komunikasi',
            ],
            [
                'nama' => 'Daycare Cerah Bandung',
                'jenis' => 'Daycare',
                'lokasi' => 'Bandung',
                'biaya' => 2000000,
                'bakat' => 'Olahraga',
            ],
        ];

        foreach ($data as $index => $item) {
            $instansi = Instansi::create([
                'pengelola_id' => $pengelolas[$index]->id,
                'nama' => $item['nama'],
                'jenis' => $item['jenis'],
                'lokasi' => $item['lokasi'],
                'bakat' => $item['bakat'],
                'biaya_pendaftaran' => $item['biaya'],
                'jam_operasional' => '07.00 - 16.00',
                'telepon' => '08123456789',
                'email' => strtolower(str_replace(' ', '', $item['nama'])) . '@test.com',
                'status' => 'approved',
            ]);

            InstansiProfile::create([
                'instansi_id' => $instansi->id,
                'sekilas_tentang_kami' =>
                    'Instansi ini merupakan data dummy untuk pengujian fitur pencarian dan perbandingan.',
                'program_pembelajaran' =>
                    'Calistung, Motorik, Sosial',
            ]);

            InstansiGallery::insert([
                [
                    'instansi_id' => $instansi->id,
                    'image_path' => 'instansi/ruangan.jpg',
                    'category' => 'ruangan',
                ],
                [
                    'instansi_id' => $instansi->id,
                    'image_path' => 'instansi/sdm.jpg',
                    'category' => 'sdm',
                ],
                [
                    'instansi_id' => $instansi->id,
                    'image_path' => 'instansi/layanan.jpg',
                    'category' => 'layanan',
                ],
            ]);
        }
    }
}
