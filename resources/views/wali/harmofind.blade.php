<x-mobile-app title="HarmoFind" :withNavbar="true">

    @push('styles')
    <style>
        /* --- LAYOUT UTAMA --- */
        .header-layer { position: absolute; top: 0; left: 0; right: 0; z-index: 10; }
        .floating-area { position: absolute; top: 220px; left: 0; right: 0; z-index: 20; padding: 0 24px; }
        
        /* Padding top disesuaikan agar konten awal tidak tertutup filter */
        .content-scroll {
            padding-top: 380px; 
            padding-left: 24px; 
            padding-right: 24px; 
            padding-bottom: 120px; 
            min-height: 100vh;
        }

        /* --- DROPDOWN LOKASI (FIXED) --- */
        .location-box { 
            background: white; 
            border-radius: 20px; 
            box-shadow: 0 10px 20px rgba(53, 119, 229, 0.15); 
            position: relative; /* Penting sebagai acuan absolute child */
            z-index: 50; 
        }

        .loc-header { 
            padding: 18px 20px; 
            display: flex; 
            align-items: center; 
            cursor: pointer; 
        }

        /* PERBAIKAN: Gunakan absolute agar mengambang */
        .loc-list { 
            display: none; 
            position: absolute; 
            top: 100%; /* Tepat di bawah header */
            left: 0; 
            right: 0; 
            background: white; 
            border-radius: 0 0 20px 20px; /* Lengkungan bawah saja */
            box-shadow: 0 15px 30px rgba(0,0,0,0.1); 
            border-top: 1px solid #f0f0f0; 
            z-index: 100; /* Layer paling atas */
            overflow: hidden;
        }

        .loc-item { 
            padding: 16px 20px; 
            font-weight: 600; 
            font-size: 15px; 
            color: #2A2A2A; 
            cursor: pointer; 
            transition: background 0.2s; 
        }
        .loc-item:hover { background: #f8f9fa; }

        /* Saat aktif, list muncul & sudut bawah header jadi kotak */
        .location-box.active .loc-list { display: block; }
        .location-box.active {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* --- BUTTON KATEGORI --- */
        .cat-btn { 
            background: white; color: #3577E5; padding: 10px; width: 100px; 
            text-align: center; border-radius: 12px; font-weight: 700; font-size: 14px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); cursor: pointer; transition: all 0.2s; 
            border: 1px solid transparent; 
        }
        .cat-btn:active { transform: scale(0.95); }
        .cat-btn.active { 
            background: #3577E5; color: white; 
            box-shadow: 0 6px 15px rgba(53, 119, 229, 0.3); 
        }

        /* --- SORT BOX --- */
        .sort-box { 
            background: white; border-radius: 15px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); position: relative; 
            min-width: 140px; z-index: 40; 
        }
        .sort-header { 
            padding: 10px 14px; display: flex; align-items: center; 
            cursor: pointer; justify-content: space-between; 
        }
        .sort-list { 
            display: none; position: absolute; top: 105%; right: 0; width: 100%; 
            background: white; border-radius: 15px; 
            box-shadow: 0 8px 20px rgba(0,0,0,0.1); overflow: hidden; 
        }
        .sort-item { 
            padding: 12px 14px; font-size: 13px; cursor: pointer; 
            border-bottom: 1px solid #f9f9f9; color: #333; font-weight: 500; 
        }
        .sort-item:last-child { border-bottom: none; }
        .sort-item:hover { background: #f0f7ff; color: #3577E5; }
        .sort-box.active .sort-list { display: block; }

        /* --- CARD STYLE --- */
        .school-card {
            display: flex; position: relative; background: white; border-radius: 16px;
            padding: 12px; margin-bottom: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            align-items: flex-start; border: 1px solid #f8f9fa; cursor: pointer; transition: transform 0.1s;
        }
        .school-card:active { transform: scale(0.98); }
        .sc-img { width: 100px; height: 100px; border-radius: 12px; object-fit: cover; flex-shrink: 0; background: #eee; }
        .sc-content { flex: 1; padding-left: 14px; display: flex; flex-direction: column; justify-content: space-between; min-height: 100px; }
        .sc-title { font-weight: 800; font-size: 15px; color: #3577E5; margin-bottom: 2px; line-height: 1.2; padding-right: 40px; }
        .sc-price { font-weight: 700; font-size: 14px; color: #3577E5; margin-bottom: 8px; }
        .sc-badge { display: inline-flex; align-items: center; background-color: #4CD964; color: white; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px; width: fit-content; margin-bottom: 8px; }
        .sc-badge i { margin-right: 5px; font-size: 11px; }
        .sc-location { font-size: 12px; color: #666; font-weight: 600; display: flex; align-items: center; }
        .sc-location i { color: #3577E5; margin-right: 6px; font-size: 14px; }
        .sc-rating { position: absolute; top: 12px; right: 12px; background: white; border: 1px solid #f0f0f0; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-radius: 20px; padding: 4px 8px; display: flex; align-items: center; font-weight: 800; font-size: 12px; color: #333; }
        .sc-rating i { color: #FFC107; margin-right: 4px; font-size: 11px; }
    </style>
    @endpush

    {{-- LAYER 1: HEADER --}}
    <div class="header-layer">
        <x-custom-header title="HarmoFind" />
    </div>

    {{-- LAYER 2: FILTER --}}
    <div class="floating-area">
        
        {{-- LOKASI --}}
        <div class="location-box" id="locationDropdown">
            <div class="loc-header" onclick="toggleLocation()">
                <i class="fa-solid fa-location-dot text-[#3577E5] text-xl mr-3"></i>
                <span id="selectedLocationLabel" class="flex-1 font-bold text-[#2A2A2A]">Bandung</span>
                <i id="locArrow" class="fa-solid fa-chevron-down text-[#3577E5]"></i>
            </div>
            <div class="loc-list">
                <div class="loc-item" onclick="selectLocation('Bandung')">Bandung</div>
                <div class="loc-item" onclick="selectLocation('Bekasi')">Bekasi</div>
                <div class="loc-item" onclick="selectLocation('Surabaya')">Surabaya</div>
            </div>
        </div>

        {{-- KATEGORI + SORT --}}
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="d-flex gap-2">
                <div class="cat-btn active" id="btnTK" onclick="selectCategory('TK/PG')">TK/PG</div>
                <div class="cat-btn" id="btnDaycare" onclick="selectCategory('Daycare')">Daycare</div>
            </div>
            <div class="sort-box" id="sortDropdown">
                <div class="sort-header" onclick="toggleSort()">
                    <div class="d-flex align-items-center text-[#3577E5] font-bold text-sm">
                        <i class="fa-solid fa-arrow-down-short-wide mr-2"></i>
                        <span id="sortLabel">Terbaru</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[#3577E5] text-xs ml-2"></i>
                </div>
                <div class="sort-list">
                    <div class="sort-item" onclick="selectSort('Terbaru')">Terbaru</div>
                    <div class="sort-item" onclick="selectSort('Terpopuler')">Terpopuler</div>
                    <div class="sort-item" onclick="selectSort('Harga Tertinggi')">Harga Tertinggi</div>
                    <div class="sort-item" onclick="selectSort('Harga Terendah')">Harga Terendah</div>
                </div>
            </div>
        </div>
    </div>

    {{-- LAYER 3: KONTEN --}}
    <div class="content-scroll">
        <div id="schoolListContainer"></div>
    </div>

    {{-- SCRIPT --}}
    @push('scripts')
    <script>
        let currentState = {
            location: 'Bandung',
            category: 'TK/PG',
            sort: 'Terbaru'
        };

        document.addEventListener('DOMContentLoaded', fetchData);

        async function fetchData() {
            const container = document.getElementById('schoolListContainer');
            
            // Tampilkan Loading
            container.innerHTML = `
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="text-gray-400 text-sm mt-2">Sedang memuat data...</p>
                </div>
            `;

            try {
                // ============================================================
                // 100% LOGIC FIX: Menggunakan URLSearchParams agar aman
                // ============================================================
                const params = new URLSearchParams();
                
                // Pastikan key-nya 'lokasi', BUKAN 'kota' (Sesuai Controller Anda)
                params.append('lokasi', currentState.location); 
                params.append('jenis', currentState.category);

                // Debugging: Cek di Console Browser apa URL yang terbentuk
                console.log("Fetching: /api/instansi?" + params.toString());

                const res = await fetch(`/api/instansi?${params.toString()}`);
                let data = await res.json();

                // --- Client Side Sorting ---
                // Karena controller pakai switch case manual, kita bantu sort di client 
                // supaya interaksi terasa cepat (tanpa request ulang sort)
                if (currentState.sort === 'Harga Tertinggi') {
                    data.sort((a, b) => b.biaya_pendaftaran - a.biaya_pendaftaran);
                } else if (currentState.sort === 'Harga Terendah') {
                    data.sort((a, b) => a.biaya_pendaftaran - b.biaya_pendaftaran);
                }

                renderList(data);

            } catch (error) {
                console.error("Error:", error);
                container.innerHTML = `
                    <div class="text-center py-5">
                        <p class="text-red-400 font-bold">Gagal memuat data</p>
                        <button onclick="fetchData()" class="mt-2 text-blue-600 font-bold">Coba Lagi</button>
                    </div>
                `;
            }
        }

        function renderList(data) {
            const container = document.getElementById('schoolListContainer');
            
            if (!data || data.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-10">
                        <i class="fa-solid fa-school-circle-xmark text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-400">Tidak ada sekolah di <br><b>${currentState.location}</b> untuk <b>${currentState.category}</b></p>
                    </div>
                `;
                return;
            }

            container.innerHTML = data.map(item => {
                let imgPath = item.image ? `/storage/${item.image}` : 'https://via.placeholder.com/150';
                let price = new Intl.NumberFormat('id-ID').format(item.biaya_pendaftaran);

                return `
                    <div class="school-card" onclick="window.location.href='/wali/sekolah/${item.id}'">
                        <img src="${imgPath}" class="sc-img">
                        <div class="sc-rating">
                            <i class="fa-solid fa-star"></i> ${item.rating ?? '5.0'}
                        </div>
                        <div class="sc-content">
                            <div>
                                <div class="sc-title">${item.nama}</div>
                                <div class="sc-price">Rp ${price} /Bulan</div>
                                <div class="sc-badge">
                                    <i class="fa-solid fa-circle-check"></i> Terpopuler
                                </div>
                            </div>
                            <div class="sc-location">
                                <i class="fa-solid fa-location-dot"></i> ${item.lokasi}
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        /* --- EVENT HANDLERS --- */
        function toggleLocation() {
            const box = document.getElementById('locationDropdown');
            const arrow = document.getElementById('locArrow');
            box.classList.toggle('active');
            
            if(box.classList.contains('active')) {
                arrow.classList.replace('fa-chevron-down', 'fa-chevron-up');
                document.getElementById('sortDropdown').classList.remove('active');
            } else {
                arrow.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
        }

        function selectLocation(val) {
            currentState.location = val;
            document.getElementById('selectedLocationLabel').innerText = val;
            toggleLocation();
            fetchData();
        }

        function selectCategory(val) {
            currentState.category = val;
            document.getElementById('btnTK').classList.toggle('active', val === 'TK/PG');
            document.getElementById('btnDaycare').classList.toggle('active', val === 'Daycare');
            fetchData();
        }

        function toggleSort() {
            document.getElementById('sortDropdown').classList.toggle('active');
            document.getElementById('locationDropdown').classList.remove('active');
        }

        function selectSort(val) {
            currentState.sort = val;
            document.getElementById('sortLabel').innerText = val.replace('Harga ', '');
            toggleSort();
            fetchData();
        }
    </script>
    @endpush

</x-mobile-app>