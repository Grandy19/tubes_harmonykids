{{-- LAYER 1: HEADER --}}
<div class="header-layer">
    <x-custom-header title="Pengaturan" />
</div>

{{-- LAYER 2: KONTEN --}}
<div class="setting-content-area">
    
    {{-- 1. Profile Singkat --}}
    <div class="profile-mini-card">
        <img src="{{ asset('assets/images/profile-placeholder.png') }}" 
             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=E3F2FD&color=3577E5'" 
             class="pm-img">
        <div class="pm-info">
            <h4>{{ $user->name ?? 'Pengguna' }}</h4>
            <p>{{ $user->email ?? 'email@contoh.com' }}</p>
        </div>
    </div>

    {{-- 2. Group Menu: AKUN --}}
    <div class="setting-group">
        <div class="group-title">Akun</div>
        <div class="menu-list">
            <a href="{{ route('wali.profile.edit') }}" class="menu-item">
                <div class="mi-left">
                    <div class="mi-icon"><i class="fa-regular fa-user"></i></div>
                    <span class="mi-text">Edit Profil</span>
                </div>
                <i class="fa-solid fa-chevron-right mi-arrow"></i>
            </a>
            
            {{-- Menu Ganti Password (AJAX) --}}
            <div class="menu-item" onclick="showChangePassword()">
                <div class="mi-left">
                    <div class="mi-icon"><i class="fa-solid fa-lock"></i></div>
                    <span class="mi-text">Ganti Password</span>
                </div>
                <i class="fa-solid fa-chevron-right mi-arrow"></i>
            </div>
        </div>
    </div>

    {{-- 3. Group Menu: APLIKASI --}}
    <div class="setting-group">
        <div class="group-title">Aplikasi</div>
        <div class="menu-list">
            
            {{-- Notifikasi --}}
            <div class="menu-item">
                <div class="mi-left">
                    <div class="mi-icon"><i class="fa-regular fa-bell"></i></div>
                    <span class="mi-text">Notifikasi</span>
                </div>
                {{-- Toggle Switch Dummy --}}
                <div style="width:40px; height:22px; background:#3577E5; border-radius:20px; position:relative;">
                    <div style="width:18px; height:18px; background:white; border-radius:50%; position:absolute; top:2px; right:2px;"></div>
                </div>
            </div>

            {{-- Bantuan --}}
            <div class="menu-item" onclick="showHelp()">
                <div class="mi-left">
                    <div class="mi-icon"><i class="fa-regular fa-circle-question"></i></div>
                    <span class="mi-text">Bantuan & FAQ</span>
                </div>
                <i class="fa-solid fa-chevron-right mi-arrow"></i>
            </div>

            {{-- Tentang Aplikasi --}}
            <div class="menu-item" onclick="showAboutApp()">
                <div class="mi-left">
                    <div class="mi-icon"><i class="fa-solid fa-circle-info"></i></div>
                    <span class="mi-text">Tentang Aplikasi</span>
                </div>
                <span style="font-size:12px; color:#94A3B8; font-weight:500;">v1.0.0</span>
            </div>

        </div> {{-- PENTING: Penutup .menu-list --}}
    </div> {{-- PENTING: Penutup .setting-group --}}

    {{-- 4. Tombol Logout (TERPISAH DARI MENU LIST) --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    {{-- Margin top ditambah agar ada jarak jelas --}}
    <div class="btn-logout mt-5 mb-5" onclick="confirmLogout()">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        Keluar Aplikasi
    </div>

    {{-- Footer Copyright --}}
    <div style="text-align:center; color:#cbd5e1; font-size:11px; margin-bottom: 20px;">
        HarmonyKids &copy; 2025
    </div>

</div>