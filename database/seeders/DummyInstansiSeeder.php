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
        // Ambil semua user pengelola
        $pengelolas = User::where('role', 'pengelola')->get();

        // JAGA-JAGA: Kalau database kosong melompong belum ada pengelola
        if ($pengelolas->isEmpty()) {
            $user = User::create([
                'name' => 'Pengelola Dummy',
                'email' => 'pengelola_dummy@test.com',
                'password' => bcrypt('password'),
                'role' => 'pengelola',
                'no_hp' => '081234567890',
            ]);
            $pengelolas = collect([$user]);
        }

        $data = [
            // --- 1. SENI & KREATIVITAS ---
            [
                'nama' => 'TK Ceria Bandung',
                'jenis' => 'TK/PG',
                'lokasi' => 'Bandung',
                'biaya' => 1200000,
                'bakat' => 'Seni & Kreativitas',
                'label' => 'Seni & Kreativitas',
            ],
            [
                'nama' => 'Daycare Pelangi Bekasi',
                'jenis' => 'Daycare',
                'lokasi' => 'Bekasi',
                'biaya' => 1850000,
                'bakat' => 'Seni & Kreativitas',
                'label' => 'Seni & Kreativitas',
            ],

            // --- 2. MUSIK ---
            [
                'nama' => 'TK Luluby Bandung',
                'jenis' => 'TK/PG',
                'lokasi' => 'Bandung',
                'biaya' => 1400000,
                'bakat' => 'Musik',
                'label' => 'Musik',
            ],
            [
                'nama' => 'Daycare Music Surabaya',
                'jenis' => 'Daycare',
                'lokasi' => 'Surabaya',
                'biaya' => 1650000,
                'bakat' => 'Musik',
                'label' => 'Musik',
            ],

            // --- 3. SAINS & EKSPERIMEN ---
            [
                'nama' => 'TK Cermat Surabaya',
                'jenis' => 'TK/PG',
                'lokasi' => 'Surabaya',
                'biaya' => 1600000,
                'bakat' => 'Sains & Eksperimen',
                'label' => 'Sains & Eksperimen',
            ],
            [
                'nama' => 'Daycare Cilik Bekasi',
                'jenis' => 'Daycare',
                'lokasi' => 'Bekasi',
                'biaya' => 2100000,
                'bakat' => 'Sains & Eksperimen',
                'label' => 'Sains & Eksperimen',
            ],

            // --- 4. AKADEMIK DASAR ---
            [
                'nama' => 'TK Pintar Surabaya',
                'jenis' => 'TK/PG',
                'lokasi' => 'Surabaya',
                'biaya' => 1500000,
                'bakat' => 'Akademik Dasar',
                'label' => 'Akademik Dasar',
            ],
            [
                'nama' => 'Daycare Cendekia Bandung',
                'jenis' => 'Daycare',
                'lokasi' => 'Bandung',
                'biaya' => 1100000,
                'bakat' => 'Akademik Dasar',
                'label' => 'Akademik Dasar',
            ],

            // --- 5. SOSIAL & KOMUNIKASI ---
            [
                'nama' => 'Daycare Bahagia Bekasi',
                'jenis' => 'Daycare',
                'lokasi' => 'Bekasi',
                'biaya' => 2200000,
                'bakat' => 'Sosial & Komunikasi',
                'label' => 'Sosial & Komunikasi',
            ],
            [
                'nama' => 'Playgroup Kawan Sejati',
                'jenis' => 'TK/PG',
                'lokasi' => 'Bandung',
                'biaya' => 1350000,
                'bakat' => 'Sosial & Komunikasi',
                'label' => 'Sosial & Komunikasi',
            ],

            // --- 6. OLAHRAGA ---
            [
                'nama' => 'Daycare Cerah Bandung',
                'jenis' => 'Daycare',
                'lokasi' => 'Bandung',
                'biaya' => 2000000,
                'bakat' => 'Olahraga',
                'label' => 'Olahraga',
            ],
            [
                'nama' => 'TK Tunas Juara Surabaya',
                'jenis' => 'TK/PG',
                'lokasi' => 'Surabaya',
                'biaya' => 1750000,
                'bakat' => 'Olahraga',
                'label' => 'Olahraga',
            ],
        ];

        foreach ($data as $index => $item) {
            $userIndex = $index % $pengelolas->count();
            $selectedUser = $pengelolas[$userIndex];

            if (Instansi::where('nama', $item['nama'])->exists()) {
                continue;
            }

            $instansi = Instansi::create([
                'pengelola_id' => $selectedUser->id,
                'nama' => $item['nama'],
                'jenis' => $item['jenis'],
                'lokasi' => $item['lokasi'],
                'bakat' => $item['bakat'],
                'label' => $item['label'],
                'biaya_pendaftaran' => $item['biaya'],
                'jam_operasional' => '07.00 - 16.00',
                'telepon' => '08123456789',
                'email' => strtolower(str_replace(' ', '', $item['nama'])) . '@test.com',
                'status' => 'approved',
            ]);

            InstansiProfile::create([
                'instansi_id' => $instansi->id,
                'sekilas_tentang_kami' => 'Data dummy untuk pengujian fitur.',
                'program_pembelajaran' => 'Calistung, Motorik, Sosial',
            ]);

            // PERBAIKAN DISINI: image_path diisi string, bukan null
            InstansiGallery::insert([
                [
                    'instansi_id' => $instansi->id,
                    'image_path' => 'instansi/default.jpg', // <--- GANTI NULL JADI STRING
                    'category' => 'ruangan',
                ],
                [
                    'instansi_id' => $instansi->id,
                    'image_path' => 'instansi/default.jpg', // <--- GANTI NULL JADI STRING
                    'category' => 'sdm',
                ],
            ]);
        }
    }
}