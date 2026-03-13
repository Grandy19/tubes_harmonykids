{{-- WRAPPER UTAMA --}}
<div class="page-container">

    {{-- HEADER --}}
    <div class="header-layer">
        <x-custom-header title='"HarmoRide"' />
    </div>

    {{-- CONTENT SCROLLABLE --}}
    <div class="content-scroll">

        {{-- LOKASI DROPDOWN --}}
        <div class="ride-location-box" id="rideLocationBox">
            <div class="ride-loc-header" onclick="toggleRideLocation()">
                <i class="fa-solid fa-location-dot me-3" style="color: #3577E5; font-size: 20px;"></i>
                <span id="rideSelectedCity" style="flex: 1; font-weight: 700; color: #333;">Pilih Lokasi</span>
                <i id="rideArrowIcon" class="fa-solid fa-chevron-down" style="color: #64B5F6;"></i>
            </div>
            <div class="ride-loc-list">
                <div class="ride-loc-item" onclick="selectRideCity('Bandung')">Bandung</div>
                <div class="ride-loc-item" onclick="selectRideCity('Bekasi')">Bekasi</div>
                <div class="ride-loc-item" onclick="selectRideCity('Surabaya')">Surabaya</div>
            </div>
        </div>

        {{-- DAFTAR DRIVER --}}
        <div id="driverList">

            @php
                $drivers = [
                    // Bandung
                    ['name' => 'Ujang Suherman',  'area' => 'Bandung', 'vehicle' => 'Mobil Avanza', 'rating' => '5,0', 'pengalaman' => '3 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/32.jpg'],
                    ['name' => 'Asep Kusnandar',   'area' => 'Bandung', 'vehicle' => 'Mobil Avanza', 'rating' => '5,0', 'pengalaman' => '5 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/45.jpg'],
                    ['name' => 'Dudu Surpati',     'area' => 'Bandung', 'vehicle' => 'Mobil Xenia',  'rating' => '4,8', 'pengalaman' => '2 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/12.jpg'],
                    // Bekasi
                    ['name' => 'Budi Santoso',     'area' => 'Bekasi',  'vehicle' => 'Mobil Innova', 'rating' => '4,9', 'pengalaman' => '4 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/67.jpg'],
                    ['name' => 'Rudi Hartono',     'area' => 'Bekasi',  'vehicle' => 'Mobil Avanza', 'rating' => '5,0', 'pengalaman' => '6 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/22.jpg'],
                    ['name' => 'Hendra Gunawan',   'area' => 'Bekasi',  'vehicle' => 'Mobil Xenia',  'rating' => '4,7', 'pengalaman' => '1 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/41.jpg'],
                    // Surabaya
                    ['name' => 'Ahmad Fauzi',      'area' => 'Surabaya','vehicle' => 'Mobil Xenia',  'rating' => '4,7', 'pengalaman' => '2 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/55.jpg'],
                    ['name' => 'Wahyu Prasetyo',   'area' => 'Surabaya','vehicle' => 'Mobil Avanza', 'rating' => '5,0', 'pengalaman' => '7 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/74.jpg'],
                    ['name' => 'Doni Setiawan',    'area' => 'Surabaya','vehicle' => 'Mobil Innova', 'rating' => '4,9', 'pengalaman' => '4 Tahun', 'photo' => 'https://randomuser.me/api/portraits/men/88.jpg'],
                ];
            @endphp

            @foreach($drivers as $driver)
            <div class="driver-card" 
                 data-area="{{ $driver['area'] }}" 
                 data-name="{{ $driver['name'] }}"
                 data-rating="{{ $driver['rating'] }}"
                 data-vehicle="{{ $driver['vehicle'] }}"
                 data-pengalaman="{{ $driver['pengalaman'] }}"
                 data-photo="{{ $driver['photo'] }}"
                 style="{{ $driver['area'] !== 'Bandung' ? 'display:none;' : '' }}"
                 onclick="openDriverModal(this)">

                {{-- Foto --}}
                <img src="{{ $driver['photo'] }}"
                     class="driver-photo"
                     alt="{{ $driver['name'] }}"
                     onerror="this.src='{{ asset('assets/images/avatar.png') }}'">

                {{-- Rating --}}
                <div class="driver-rating">
                    <i class="fa-solid fa-star"></i> {{ $driver['rating'] }}
                </div>

                {{-- Informasi --}}
                <div class="driver-info">
                    <div class="driver-name">{{ $driver['name'] }}</div>

                    <div class="driver-section-label">Area Layanan:</div>
                    <div class="driver-detail-val">
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $driver['area'] }}
                    </div>

                    <div class="driver-section-label">Tipe Kendaraan:</div>
                    <div class="driver-detail-val">
                        <i class="fa-solid fa-car"></i>
                        {{ $driver['vehicle'] }}
                    </div>
                </div>

            </div>
            @endforeach

        </div>

        {{-- EMPTY STATE (tersembunyi, muncul via JS) --}}
        <div id="emptyState" class="empty-state" style="display:none;">
            <i class="fa-solid fa-car-side"></i>
            <p>Tidak ada driver tersedia<br>di area ini</p>
        </div>

        <div style="height: 20px;"></div>
    </div>

    {{-- MODAL DRIVER DETAIL --}}
    <div id="driverDetailModal" class="driver-modal" style="display: none;">
        
        {{-- Bagian Atas: Foto Background & Info Header --}}
        <div class="modal-top">
            <img id="modalBgImg" src="" class="modal-bg-img" alt="Background">
            <div class="modal-overlay"></div>
            
            {{-- Tombol Header --}}
            <div class="modal-header-icons">
                <button class="modal-back-btn" onclick="closeDriverModal()">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button class="modal-heart-btn">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </div>

            {{-- Info Header --}}
            <div class="modal-info-overlay">
                <h2 id="modalNameTop">Nama Driver</h2>
                <p id="modalAreaTop">Area Layanan: Lokasi</p>
                <div class="modal-rating-badge">
                    <i class="fa-solid fa-star"></i> <span id="modalRatingTop">5,0</span>
                </div>
            </div>
        </div>

        {{-- Bagian Bawah: Profil & Kendaraan --}}
        <div class="modal-bottom">
            
            {{-- Tabs --}}
            <div class="modal-tabs">
                <button class="modal-tab active" id="btnTabProfil" onclick="switchDriverTab('profil')">Profil</button>
                <button class="modal-tab" id="btnTabKendaraan" onclick="switchDriverTab('kendaraan')">Kendaraan</button>
            </div>

            {{-- KONTEN: PROFIL --}}
            <div id="tabContentProfil" class="tab-content active">
                <div class="profil-card-blue">
                    <img id="modalProfileImg" src="" class="profil-thumb" alt="Profile">
                    
                    <div class="profil-details">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 id="modalNameInner">Nama Driver</h3>
                                <div class="profil-id">ID Pengemudi <span class="fw-bold text-white ms-2">US - 01 - 40 - 1997</span></div>
                                <div class="profil-loc"><i class="fa-solid fa-location-dot"></i> JL. Pasir Kaliki No.9</div>
                            </div>
                            <div class="profil-right text-end">
                                <div class="profil-kartu-label">Kartu<br>Pengemudi</div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-end mt-2">
                            <div class="profil-online">Sedang Online</div>
                            <i class="fa-solid fa-circle-exclamation text-white fs-5"></i>
                        </div>
                    </div>
                </div>

                <button class="btn-wa">Hubungi melalui WhatsApp</button>
            </div>

            {{-- KONTEN: KENDARAAN --}}
            <div id="tabContentKendaraan" class="tab-content">
                {{-- Placeholder / Image Mobil --}}
                <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=800" class="car-photo" alt="Mobil">
                
                <div class="kendaraan-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 id="modalNameVehicle" class="k-title">Nama Driver</h3>
                        <div class="kendaraan-kartu-label text-end">Kartu<br>Kendaraan</div>
                    </div>
                    
                    <div class="k-row">
                        <span class="k-label">Jenis Kendaraan</span>
                        <span class="k-val" id="modalVehicleType">Mobil Avanza</span>
                    </div>
                    <div class="k-row">
                        <span class="k-label">Tahun Kendaraan</span>
                        <span class="k-val">2010</span>
                    </div>
                    <div class="k-row">
                        <span class="k-label">Kapasitas Penumpang</span>
                        <span class="k-val">7 Orang</span>
                    </div>
                    <div class="k-row">
                        <span class="k-label">Pengalaman</span>
                        <span class="k-val" id="modalPengalaman">3 Tahun</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
