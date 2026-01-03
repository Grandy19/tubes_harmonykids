<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Forum\Models\ForumPost;
use App\Models\User;

class DummyForumSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil wali
        $wali = User::where('role', 'wali')->first();

        if (! $wali) {
            $this->command->warn('Seeder forum dibatalkan: tidak ada akun wali.');
            return;
        }

        $posts = [
            [
                'content' => 'Anak saya baru masuk TK, ada rekomendasi instansi yang bagus di Bandung?',
                'likes' => 5,
            ],
            [
                'content' => 'Pengalaman saya di TK Ceria cukup bagus, gurunya ramah.',
                'likes' => 12,
            ],
            [
                'content' => 'Ada yang punya pengalaman daycare di Bekasi?',
                'likes' => 2,
            ],
            [
                'content' => 'Menurut saya program seni sangat penting untuk anak usia dini.',
                'likes' => 8,
            ],
        ];

        foreach ($posts as $post) {
            ForumPost::create([
                'wali_id' => $wali->id,
                'content' => $post['content'],
                'likes' => $post['likes'],
                'image' => null, 
            ]);
        }
    }
}
