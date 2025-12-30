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