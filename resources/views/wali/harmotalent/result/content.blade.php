{{-- WRAPPER UTAMA --}}
<div class="page-container">

    {{-- LAYER 1: HEADER (Fixed) --}}
    <div class="header-layer">
        <x-custom-header title="HarmoTalent" />
    </div>

    {{-- LAYER 2: CONTENT & FILTER (Scrollable) --}}
    <div class="content-scroll">
        
        {{-- A. BAGIAN FILTER (Struktur HarmoFind) --}}
        <div class="filter-area-scroll" style="padding: 0 24px; position: relative; z-index: 20;"> 
            
            {{-- 1. LOKASI --}}
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

            {{-- 2. KATEGORI + SORT --}}
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="d-flex gap-2">
                    {{-- ID disamakan dengan HarmoFind untuk konsistensi script --}}
                    <div class="cat-btn {{ ($kategori ?? 'TK/PG') == 'TK/PG' ? 'active' : '' }}" 
                         id="btnTK" 
                         onclick="selectCategory('TK/PG', this)">
                         TK/PG
                    </div>

                    <div class="cat-btn {{ ($kategori ?? '') == 'Daycare' ? 'active' : '' }}" 
                         id="btnDaycare" 
                         onclick="selectCategory('Daycare', this)">
                         Daycare
                    </div>
                </div>
                
                <div class="sort-box" id="sortDropdown">
                    <div class="sort-header" onclick="toggleSort()">
                        <div class="d-flex align-items-center text-[#3577E5] font-bold text-sm">
                            <i class="fa-solid fa-arrow-down-short-wide mr-2"></i>
                            <span id="sortLabel">
                                {{ $sort === 'termurah' ? 'Termurah' : 'Terbaru' }}
                            </span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-[#3577E5] text-xs ml-2"></i>
                    </div>
                    <div class="sort-list">
                        <div class="sort-item" onclick="selectSort('Terbaru')">Terbaru</div>
                        <div class="sort-item" onclick="selectSort('Harga Tertinggi')">Harga Tertinggi</div>
                        <div class="sort-item" onclick="selectSort('Harga Terendah')">Harga Terendah</div>
                    </div>
                </div>
            </div>

            {{-- 3. INFO HASIL BAKAT (Khusus HarmoTalent) --}}
            <div class="mt-4 mb-2">
                <h6 class="fw-bold text-[#1E293B] text-[15px] m-0">
                    Hasil untuk: <span class="text-[#3577E5]">{{ $bakat }}</span>
                </h6>
            </div>

        </div> 
        {{-- AKHIR BAGIAN FILTER --}}

        {{-- B. LIST SEKOLAH --}}
        {{-- ID disamakan dengan HarmoFind: 'schoolListContainer' --}}
        <div id="schoolListContainer" class="mt-4 pb-20">
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="text-muted mt-2 small">Memuat data...</p>
            </div>
        </div>

    </div>
</div>