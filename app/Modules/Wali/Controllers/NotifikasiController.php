<?php

namespace App\Modules\Wali\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pendaftaran\Models\Pendaftaran;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        // Jika request dari API (Mobile)
        if ($request->wantsJson() || $request->is('api/*')) {
            $user = $request->user();
            $notifications = [];
    
            // 1. Pendaftaran Notifications
            $pendaftarans = Pendaftaran::with('instansi')
                ->where('wali_id', $user->id)
                ->get();
    
            foreach ($pendaftarans as $p) {
                // Initial Submission Notification
                $notifications[] = [
                    'type' => 'pendaftaran_berhasil',
                    'title' => 'Pendaftaran Berhasil',
                    'message' => 'Pendaftaran anda di ' . ($p->instansi->nama ?? 'Instansi') . ' berhasil dikirim.',
                    'created_at' => $p->created_at,
                    'is_read' => false, 
                    'data' => $p
                ];
    
                // Status Update Notification
                if ($p->status == 'accepted' || $p->status == 'approved' || $p->status == 'diterima') {
                    $notifications[] = [
                        'type' => 'pendaftaran_diterima',
                        'title' => 'Pendaftaran Diterima',
                        'message' => 'Selamat! Pendaftaran anda di ' . ($p->instansi->nama ?? 'Instansi') . ' telah diterima.',
                        // Menggunakan updated_at sebagai proxy waktu persetujuan
                        'created_at' => $p->updated_at,
                        'is_read' => false,
                        'data' => $p
                    ];
                } elseif ($p->status == 'rejected' || $p->status == 'ditolak') {
                     $notifications[] = [
                        'type' => 'pendaftaran_ditolak',
                        'title' => 'Pendaftaran Ditolak',
                        'message' => 'Mohon maaf, pendaftaran anda di ' . ($p->instansi->nama ?? 'Instansi') . ' belum dapat diterima.',
                        'created_at' => $p->updated_at,
                        'is_read' => false,
                        'data' => $p
                    ];
                }
            }
    
            // 2. Forum Post Notifications
            try {
                $posts = \App\Modules\Forum\Models\ForumPost::where('wali_id', $user->id)->get();
                foreach ($posts as $post) {
                    $notifications[] = [
                        'type' => 'postingan_berhasil',
                        'title' => 'Postingan Berhasil Dibuat',
                        'message' => 'Postingan anda berhasil diterbitkan di HarmoTalk.',
                        'created_at' => $post->created_at,
                        'is_read' => false,
                        'data' => $post
                    ];
                }
            } catch (\Exception $e) {
                // Ignore if Forum module issue
            }

            // 3. User Account Notifications (Optional - Simulated for consistency if recently updated)
            if ($user->updated_at && $user->updated_at->diffInHours(now()) < 24) {
                 $notifications[] = [
                    'type' => 'akun_diperbarui',
                    'title' => 'Akun Berhasil Diperbarui',
                    'message' => 'Data profil anda baru saja diperbarui.',
                    'created_at' => $user->updated_at,
                    'is_read' => false,
                ];
            }
    
            // Sort by created_at desc
            usort($notifications, function($a, $b) {
                return $b['created_at']->timestamp <=> $a['created_at']->timestamp;
            });
            
            return response()->json([
                'success' => true,
                'data' => $notifications
            ]);
        }

        // Existing Web View Logic
        $notifikasi = Pendaftaran::with('instansi')
            ->where('wali_id', $request->user()->id)
            ->latest()
            ->get();

        return view('wali.notifikasi.index', compact('notifikasi'));
    }
}
