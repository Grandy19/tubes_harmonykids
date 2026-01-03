<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Modules\Instansi\Models\Instansi;
use App\Modules\Instansi\Models\InstansiProfile;
use App\Modules\Instansi\Models\InstansiGallery;

class DummyInstansiSeeder extends Seeder
{
    public function run(): void
    {
        $pengelolas = User::where('role', 'pengelola')->get();
        $data = [
            // Seni & Kreativitas
            ['nama'=>'TK Ceria Bandung',        'jenis'=>'TK/PG',   'lokasi'=>'Bandung',   'biaya'=>1200000, 'bakat'=>'Seni & Kreativitas', 'label'=>'Seni & Kreativitas'],
            ['nama'=>'Daycare Pelangi Bekasi',  'jenis'=>'Daycare', 'lokasi'=>'Bekasi',    'biaya'=>1800000, 'bakat'=>'Seni & Kreativitas', 'label'=>'Seni & Kreativitas'],

            // Akademik Dasar
            ['nama'=>'TK Pintar Bandung',       'jenis'=>'TK/PG',   'lokasi'=>'Bandung',   'biaya'=>1500000, 'bakat'=>'Akademik Dasar',     'label'=>'Akademik Dasar'],
            ['nama'=>'Daycare Cendekia',        'jenis'=>'Daycare', 'lokasi'=>'Bandung',   'biaya'=>1700000, 'bakat'=>'Akademik Dasar',     'label'=>'Akademik Dasar'],

            // Sosial & Komunikasi
            ['nama'=>'TK Bahagia Bekasi',       'jenis'=>'TK/PG',   'lokasi'=>'Bekasi',    'biaya'=>1300000, 'bakat'=>'Sosial & Komunikasi','label'=>'Sosial & Komunikasi'],
            ['nama'=>'Daycare Sahabat',         'jenis'=>'Daycare', 'lokasi'=>'Bekasi',    'biaya'=>1900000, 'bakat'=>'Sosial & Komunikasi','label'=>'Sosial & Komunikasi'],

            // Musik
            ['nama'=>'TK Luluby Surabaya',      'jenis'=>'TK/PG',   'lokasi'=>'Surabaya',  'biaya'=>1400000, 'bakat'=>'Musik',              'label'=>'Musik'],
            ['nama'=>'Daycare Music Kids',      'jenis'=>'Daycare', 'lokasi'=>'Surabaya',  'biaya'=>1650000, 'bakat'=>'Musik',              'label'=>'Musik'],

            // Sains & Eksperimen
            ['nama'=>'TK Cermat Bandung',       'jenis'=>'TK/PG',   'lokasi'=>'Bandung',   'biaya'=>1550000, 'bakat'=>'Sains & Eksperimen', 'label'=>'Sains & Eksperimen'],
            ['nama'=>'Daycare Explorer',        'jenis'=>'Daycare', 'lokasi'=>'Bandung',   'biaya'=>1750000, 'bakat'=>'Sains & Eksperimen', 'label'=>'Sains & Eksperimen'],

            // Olahraga
            ['nama'=>'TK Tunas Juara',           'jenis'=>'TK/PG',   'lokasi'=>'Surabaya',  'biaya'=>1600000, 'bakat'=>'Olahraga',           'label'=>'Olahraga'],
            ['nama'=>'Daycare Aktif Ceria',      'jenis'=>'Daycare', 'lokasi'=>'Surabaya',  'biaya'=>2000000, 'bakat'=>'Olahraga',           'label'=>'Olahraga'],
        ];

        foreach ($pengelolas as $index => $pengelola) {

            if (!isset($data[$index])) break;

            $item = $data[$index];

            // 1 pengelola = 1 instansi
            if (Instansi::where('pengelola_id', $pengelola->id)->exists()) {
                continue;
            }

            $instansi = Instansi::create([
                'pengelola_id'      => $pengelola->id,
                'nama'              => $item['nama'],
                'jenis'             => $item['jenis'],
                'lokasi'            => $item['lokasi'],
                'bakat'             => $item['bakat'],
                'label'             => $item['label'],
                'biaya_pendaftaran' => $item['biaya'],
                'jam_operasional'   => '07.00 - 16.00',
                'telepon'           => '08123456789',
                'email'             => strtolower(str_replace(' ', '', $item['nama'])) . '@test.com',
                'status'            => 'approved',
            ]);

            InstansiProfile::create([
                'instansi_id' => $instansi->id,
                'sekilas_tentang_kami' => 'Data dummy untuk pengujian aplikasi HarmonyKids.',
                'program_pembelajaran' => 'Calistung, Motorik, Sosial',
            ]);

            // Galeri wajib
            InstansiGallery::insert([
                ['instansi_id'=>$instansi->id,'image_path'=>'instansi/default.jpg','category'=>'utama'],
                ['instansi_id'=>$instansi->id,'image_path'=>'instansi/default.jpg','category'=>'profil'],
                ['instansi_id'=>$instansi->id,'image_path'=>'instansi/default.jpg','category'=>'fasilitas'],
                ['instansi_id'=>$instansi->id,'image_path'=>'instansi/default.jpg','category'=>'sdm'],
            ]);
        }
    }
}
