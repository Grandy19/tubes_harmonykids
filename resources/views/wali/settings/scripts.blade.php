@push('scripts')
{{-- Load SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // --- 1. Fungsi Konfirmasi Logout ---
    function confirmLogout() {
        Swal.fire({
            target: '.mobile-card', 
            heightAuto: false, // Mencegah scroll terkunci
            title: 'Ingin Keluar?',
            text: "Anda harus login kembali untuk mengakses aplikasi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#64748B',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            width: '85%',
            customClass: {
                container: 'absolute-swal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    // --- 2. Fungsi Tentang Aplikasi ---
    function showAboutApp() {
        Swal.fire({
            target: '.mobile-card',
            heightAuto: false,
            
            // Header
            title: '<span style="color:#3577E5; font-weight:800; font-size:22px;">HarmonyKids</span>',
            
            // Konten HTML
            html: `
                <div style="display:flex; flex-direction:column; align-items:center; gap:15px;">
                    <img src="{{ asset('assets/images/logo.png') }}" 
                         alt="HarmonyKids Logo" 
                         style="width: 100px; height: auto; object-fit: contain;">

                    <p style="font-size:14px; color:#475569; line-height:1.6; text-align:center; margin: 0 10px;">
                        <strong>HarmonyKids</strong> yaitu platform digital untuk membantu para wali mencari sekolah tk/pg dan daycare sesuai kebutuhan anak.
                    </p>

                    <div style="margin-top:10px; border-top:1px solid #f1f5f9; padding-top:15px; width:100%;">
                        <span style="font-size:12px; color:#64748B; font-weight:700; background:#F1F5F9; padding:4px 10px; border-radius:20px;">
                            Versi 1.0.0
                        </span>
                        <div style="font-size:11px; color:#94A3B8; margin-top:8px;">
                            Dibuat dengan ❤️ oleh Tim HarmonyKids
                        </div>
                    </div>
                </div>
            `,
            
            showConfirmButton: true,
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#3577E5',
            width: '85%',
            padding: '1.5em',
            background: '#fff',
            backdrop: `rgba(0,0,0,0.5)`
        });
    }

    // --- 3. Fungsi Bantuan & FAQ ---
    function showHelp() {
        Swal.fire({
            target: '.mobile-card',
            heightAuto: false,
            
            // Header
            title: '<span style="color:#3577E5; font-weight:800; font-size:20px;">Pusat Bantuan</span>',
            
            // Konten HTML
            html: `
                <div style="display:flex; flex-direction:column; gap:15px; text-align:left;">
                    <p style="font-size:13px; color:#64748B; text-align:center; margin-bottom:5px;">
                        Hubungi tim admin kami jika Anda mengalami kendala:
                    </p>

                    <div style="display:flex; align-items:center; gap:15px; background:#F8FAFC; padding:15px; border-radius:16px; border:1px solid #E2E8F0;">
                        <div style="width:45px; height:45px; background:#DCFCE7; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#16A34A; flex-shrink:0;">
                            <i class="fa-brands fa-whatsapp" style="font-size:24px;"></i>
                        </div>
                        <div>
                            <div style="font-size:11px; color:#64748B; font-weight:500;">WhatsApp Admin</div>
                            <div style="font-size:15px; font-weight:800; color:#333; letter-spacing:0.5px;">
                                0812-3456-7890
                            </div>
                        </div>
                    </div>

                    <div style="display:flex; align-items:center; gap:15px; background:#F8FAFC; padding:15px; border-radius:16px; border:1px solid #E2E8F0;">
                        <div style="width:45px; height:45px; background:#DBEAFE; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#3577E5; flex-shrink:0;">
                             <i class="fa-regular fa-envelope" style="font-size:22px;"></i>
                        </div>
                        <div>
                            <div style="font-size:11px; color:#64748B; font-weight:500;">Email Support</div>
                            <div style="font-size:15px; font-weight:800; color:#333;">
                                admin@harmony.com
                            </div>
                        </div>
                    </div>
                </div>
            `,
            
            showConfirmButton: true,
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#3577E5',
            width: '85%',
            padding: '1.5em',
            background: '#fff',
            backdrop: `rgba(0,0,0,0.5)`
        });
    }

    // --- 4. Fungsi Ganti Password (AJAX Real-time) ---
    function showChangePassword() {
        Swal.fire({
            target: '.mobile-card',
            heightAuto: false,
            title: '<span style="color:#3577E5; font-weight:800; font-size:20px;">Ganti Password</span>',
            
            // Form Input HTML
            html: `
                <div style="display:flex; flex-direction:column; gap:15px; text-align:left;">
                    
                    <div>
                        <label style="font-size:12px; font-weight:600; color:#64748B; margin-bottom:5px; display:block;">Password Baru</label>
                        <input type="password" id="new_password" class="swal2-input" placeholder="Minimal 6 karakter" 
                               style="margin:0; width:100%; font-size:14px; border-radius:12px; border:1px solid #cbd5e1;">
                    </div>

                    <div>
                        <label style="font-size:12px; font-weight:600; color:#64748B; margin-bottom:5px; display:block;">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" class="swal2-input" placeholder="Ulangi password baru" 
                               style="margin:0; width:100%; font-size:14px; border-radius:12px; border:1px solid #cbd5e1;">
                    </div>
                </div>
            `,
            
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3577E5',
            cancelButtonColor: '#64748B',
            width: '85%',
            padding: '1.5em',
            background: '#fff',
            backdrop: `rgba(0,0,0,0.5)`,
            
            // Logika saat tombol Simpan diklik
            preConfirm: () => {
                const password = document.getElementById('new_password').value;
                const confirmation = document.getElementById('confirm_password').value;

                // A. Validasi Sederhana di Client
                if (!password || !confirmation) {
                    Swal.showValidationMessage('Semua kolom harus diisi');
                    return false;
                }
                if (password.length < 6) {
                    Swal.showValidationMessage('Password minimal 6 karakter');
                    return false;
                }
                if (password !== confirmation) {
                    Swal.showValidationMessage('Konfirmasi password tidak cocok');
                    return false;
                }

                // B. Kirim ke Server (AJAX)
                // Pastikan route 'wali.settings.password' sudah ada di web.php
                return fetch("{{ route('wali.settings.password') }}", {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token Wajib Laravel
                    },
                    body: JSON.stringify({
                        password: password,
                        password_confirmation: confirmation
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        // Jika error dari server (misal validasi backend gagal)
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(`Gagal: ${error}`);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Sukses Update
                Swal.fire({
                    target: '.mobile-card',
                    heightAuto: false,
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Password Anda telah diperbarui.',
                    confirmButtonColor: '#3577E5',
                    width: '85%'
                });
            }
        });
    }
</script>
@endpush