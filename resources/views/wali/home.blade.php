{{-- 1. Aktifkan Navbar lewat props :withNavbar="true" --}}
<x-mobile-app title="Home - HarmonyKids" :withNavbar="true">

    {{-- CSS KHUSUS HALAMAN HOME --}}
    @push('styles')
    <style>
        /* Header Fixed (Secara visual di atas, tapi ikut scroll) */
        .header-container {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 300px; z-index: 10;
        }

        .header-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 245px;
            background: url("{{ asset('assets/images/texture.png') }}");
            background-size: cover; background-color: #3577E5;
            border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;
        }

        .cloud-img {
            position: absolute; top: 195px; left: 0; width: 100%; height: 70px;
            object-fit: fill; z-index: 2;
        }

        .profile-row {
            position: absolute; top: 40px; left: 24px; right: 24px;
            display: flex; justify-content: space-between; align-items: center; z-index: 3;
        }

        .avatar-circle {
            width: 45px; height: 45px; border-radius: 50%; border: 2px solid white;
            /* GAMBAR DIHAPUS DARI SINI, PINDAH KE HTML BIAR DINAMIS */
            background-size: cover; background-color: #ddd; display: block;
        }

        .user-info { margin-left: 12px; color: white; display: flex; flex-direction: column; }
        .greeting { font-size: 14px; opacity: 0.9; line-height: 1; }
        .username { font-size: 20px; font-weight: 800; line-height: 1.2; }
        .logo-img { height: 60px; }

        /* Search Bar & Dropdown */
        .location-bar-wrapper {
            position: absolute; top: 115px; left: 24px; right: 24px; z-index: 20;
        }
        .location-bar {
            background: white; height: 55px; border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            display: flex; align-items: center; padding: 0 20px;
            cursor: pointer; transition: all 0.3s;
        }
        .dropdown-menu-custom {
            background: white; border-radius: 16px; margin-top: 8px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            overflow: hidden; display: none; position: absolute; width: 100%;
        }
        .location-bar-wrapper.active .dropdown-menu-custom { display: block; }
        .dropdown-item-custom {
            padding: 12px 20px; font-weight: 600; font-size: 14px; color: #333;
            cursor: pointer; border-bottom: 1px solid #eee;
        }
        .dropdown-item-custom:hover { background-color: #f8f9fa; }

        /* Content Scroll Area */
        .content-scroll {
            padding: 280px 24px 1px 24px; 
            min-height: 100%; 
        }

        /* Promo Banner */
        .promo-banner {
            width: 100%; height: 160px; border-radius: 20px;
            background: linear-gradient(90deg, #3577E5 0%, #5A9BF8 100%);
            box-shadow: 0 8px 15px rgba(53, 119, 229, 0.4);
            position: relative; overflow: hidden; margin-bottom: 30px;
        }
        .banner-text-area { padding: 24px; width: 60%; z-index: 2; position: relative; }
        .banner-quote { color: white; font-size: 18px; font-weight: 700; line-height: 1.4; margin-bottom: 15px; }
        .btn-banner {
            background: white; color: #0F3974; font-weight: 800; font-size: 14px;
            padding: 8px 20px; border-radius: 12px; text-decoration: none; display: inline-block;
            box-shadow: 0 4px 0 #D8D5EA; transition: transform 0.1s;
        }
        .btn-banner:active { transform: translateY(2px); box-shadow: 0 2px 0 #D8D5EA; }
        .banner-img-child { position: absolute; right: 10px; bottom: 0; height: 140px; z-index: 1; }

        /* Grid Menu */
        .menu-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px 15px; margin-bottom: 30px; }
        .menu-item { display: flex; flex-direction: column; align-items: center; text-decoration: none; color: #0F3974; transition: transform 0.2s; }
        .menu-item:hover { transform: translateY(-5px); }
        .menu-icon-box {
            width: 65px; height: 65px; background: white; border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; margin-bottom: 8px;
        }
        .menu-icon-box img { width: 40px; height: 40px; object-fit: contain; }
        .menu-title { font-size: 13px; font-weight: 700; text-align: center; }

        /* Rekomendasi Cards */
        .recom-card {
            display: flex; position: relative; background: white; border-radius: 16px;
            padding: 12px; margin-bottom: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            align-items: flex-start; border: 1px solid #f8f9fa;
        }
        .recom-img { width: 100px; height: 100px; border-radius: 12px; object-fit: cover; flex-shrink: 0; }
        .recom-content { flex: 1; padding-left: 14px; display: flex; flex-direction: column; justify-content: space-between; min-height: 100px; }
        .recom-title { font-weight: 800; font-size: 15px; color: #3577E5; margin-bottom: 2px; line-height: 1.2; padding-right: 40px; }
        .recom-price { font-weight: 700; font-size: 14px; color: #3577E5; margin-bottom: 8px; }
        .recom-badge { display: inline-flex; align-items: center; background-color: #4CD964; color: white; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px; width: fit-content; margin-bottom: 8px; }
        .recom-badge i { margin-right: 5px; font-size: 11px; }
        .recom-location { font-size: 12px; color: #666; font-weight: 600; display: flex; align-items: center; }
        .recom-location i { color: #3577E5; margin-right: 6px; font-size: 14px; }
        .recom-rating { position: absolute; top: 12px; right: 12px; background: white; border: 1px solid #f0f0f0; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-radius: 20px; padding: 4px 8px; display: flex; align-items: center; font-weight: 800; font-size: 12px; color: #333; }
        .recom-rating i { color: #FFC107; margin-right: 4px; font-size: 11px; }
        .btn-more { display: block; background: #3577E5; color: white; padding: 14px; border-radius: 14px; text-align: center; font-weight: 800; text-decoration: none; margin-top: 10px; }
    </style>
    @endpush

    {{-- HEADER (Absolute relative to Content Wrapper) --}}
    <div class="header-container">
        <div class="header-bg"></div>
        <img src="{{ asset('assets/images/cloud.png') }}" class="cloud-img" alt="cloud">

        {{-- BAGIAN PROFILE (SUDAH DIPERBAIKI) --}}
        <div class="profile-row">
            {{-- Klik area ini akan mengarah ke edit profile --}}
            <a href="{{ route('wali.profile.edit') }}" class="d-flex align-items-center" style="text-decoration: none;">
                
                @php
                    $user = Auth::user();
                    // Cek database: kalau ada foto upload pakai itu, kalau tidak pakai default
                    $foto = ($user && $user->foto_profil) 
                        ? asset('storage/' . $user->foto_profil) 
                        : asset('assets/images/avatar.png');
                @endphp

                {{-- Gambar dipasang lewat inline style agar dinamis sesuai user --}}
                <div class="avatar-circle" style="background-image: url('{{ $foto }}');"></div>
                
                <div class="user-info">
                    <span class="greeting">Hallo, Selamat Datang!</span>
                    {{-- Nama diambil langsung dari database --}}
                    <span class="username">{{ $user->name ?? 'Tamu' }}</span>
                </div>
            </a>

            <img src="{{ asset('assets/images/logo.png') }}" class="logo-img" alt="Logo">
        </div>

        <div class="location-bar-wrapper" id="locationWrapper">
            <div class="location-bar" onclick="toggleDropdown()">
                <i class="fa-solid fa-location-dot me-3" style="color: #3577E5; font-size: 24px;"></i>
                <span id="selectedCity" style="flex: 1; font-weight: 700; color: #333;">Pilih Lokasi</span>
                <i id="arrowIcon" class="fa-solid fa-chevron-down" style="color: #64B5F6;"></i>
            </div>
            <div class="dropdown-menu-custom">
                <div class="dropdown-item-custom" onclick="selectCity('Bandung')">Bandung</div>
                <div class="dropdown-item-custom" onclick="selectCity('Bekasi')">Bekasi</div>
                <div class="dropdown-item-custom" onclick="selectCity('Surabaya')">Surabaya</div>
            </div>
        </div>
    </div>

    {{-- KONTEN SCROLL --}}
    <div class="content-scroll">
        {{-- PROMO --}}
        <div class="promo-banner">
            <div class="banner-text-area">
                <div class="banner-quote">“Cari Sekolah Anak Lebih Mudah”</div>
                <a href="#" class="btn-banner">Klik Disini</a>
            </div>
            <img src="{{ asset('assets/images/anak_playground.png') }}" class="banner-img-child" alt="Child">
        </div>

        {{-- GRID MENU --}}
        <div class="menu-grid">
            <a href="{{ route('wali.harmofind') }}" class="menu-item">
                <div class="menu-icon-box"><img src="{{ asset('assets/images/find.png') }}" alt="Find"></div>
                <div class="menu-title">HarmoFind</div>
            </a>
            <a href="{{ route('wali.harmoview') }}" class="menu-item">
                <div class="menu-icon-box"><img src="{{ asset('assets/images/view.png') }}" alt="View"></div>
                <div class="menu-title">HarmoView</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon-box"><img src="{{ asset('assets/images/talent.png') }}" alt="Talent"></div>
                <div class="menu-title">HarmoTalent</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon-box"><img src="{{ asset('assets/images/talk.png') }}" alt="Talk"></div>
                <div class="menu-title">HarmoTalk</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon-box"><img src="{{ asset('assets/images/ride.png') }}" alt="Ride"></div>
                <div class="menu-title">HarmoRide</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon-box"><img src="{{ asset('assets/images/tale.png') }}" alt="Tale"></div>
                <div class="menu-title">HarmoTale</div>
            </a>
        </div>

        {{-- REKOMENDASI --}}
        <div id="rekomendasiSection" style="display:none;">
            <div style="font-size:18px; font-weight:800; color:#0F3974; margin-bottom:15px;">
                Rekomendasi Terbaik
            </div>

            <div id="rekomendasiList"></div>

            <a id="btnSelengkapnya" href="#" class="btn-more">
                Selengkapnya
            </a>
        </div>
        <div style="height: 120px;"></div>
    </div>

    {{-- JAVASCRIPT --}}
    @push('scripts')
    <script>
        // JS lama untuk ambil nama dari localStorage SUDAH DIHAPUS karena diganti Blade.

        function toggleDropdown() {
            const wrapper = document.getElementById('locationWrapper');
            const arrow = document.getElementById('arrowIcon');
            wrapper.classList.toggle('active');
            
            if (wrapper.classList.contains('active')) {
                arrow.classList.replace('fa-chevron-down', 'fa-chevron-up');
            } else {
                arrow.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
        }

        function selectCity(cityName) {
            document.getElementById('selectedCity').innerText = cityName;
            toggleDropdown();
            loadRekomendasi(cityName);
        }

        async function loadRekomendasi(city) {
            const section = document.getElementById('rekomendasiSection');
            const list = document.getElementById('rekomendasiList');
            const btnMore = document.getElementById('btnSelengkapnya');

            section.style.display = 'block';
            list.innerHTML = '<p style="text-align:center; padding:20px;">Memuat data...</p>';

            try {
                const res = await fetch(`/api/instansi?lokasi=${city}&limit=3`);
                const data = await res.json();

                list.innerHTML = '';

                if (data.length === 0) {
                    list.innerHTML = '<p style="text-align:center;color:#999;">Tidak ada instansi.</p>';
                }

                data.forEach(item => {
                    const imgPath = item.image ? `/storage/${item.image}` : 'https://via.placeholder.com/100';
                    
                    list.innerHTML += `
                        <div class="recom-card">
                            <img src="${imgPath}" class="recom-img">
                            <div class="recom-rating">
                                <i class="fa-solid fa-star"></i> ${item.rating ?? '5.0'}
                            </div>
                            <div class="recom-content">
                                <div>
                                    <div class="recom-title">${item.nama}</div>
                                    <div class="recom-price">Rp ${Number(item.biaya_pendaftaran).toLocaleString()} /Bulan</div>
                                    <div class="recom-badge">
                                        <i class="fa-solid fa-circle-check"></i> Terpopuler
                                    </div>
                                </div>
                                <div class="recom-location">
                                    <i class="fa-solid fa-location-dot"></i> ${item.lokasi}
                                </div>
                            </div>
                        </div>
                    `;
                });

                btnMore.href = `{{ route('wali.harmofind') }}?lokasi=${city}`;
            } catch (e) {
                list.innerHTML = '<p style="text-align:center;color:red;">Gagal memuat data</p>';
                console.error(e);
            }
        }
    </script>
    @endpush
</x-mobile-app>