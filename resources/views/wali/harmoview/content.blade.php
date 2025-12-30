<div class="header-layer">
    <x-custom-header title="HarmoView" />
</div>

<div class="content-scroll">

    {{-- INPUT 1 --}}
    <div class="search-pill" style="z-index: 30;">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <select id="instansi1" class="compare-select">
            <option value="" placeholder>Pilih Instansi 1...</option>
        </select>
        <div class="dot-indicator dot-blue"></div>
    </div>

    {{-- TEKS DI TENGAH --}}
    <div class="label-center">
        Cari untuk Membandingkan
    </div>

    {{-- INPUT 2 --}}
    <div class="search-pill" style="z-index: 20;">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <select id="instansi2" class="compare-select">
            <option value="" placeholder>Pilih Instansi 2...</option>
        </select>
        <div class="dot-indicator dot-red"></div>
    </div>

    {{-- CHART SECTION --}}
    <div id="chartSection" class="chart-card">
        <div class="chart-title">Hasil Perbandingan</div>
        <div style="height: 250px;">
            <canvas id="compareChart"></canvas>
        </div>
    </div>

    {{-- RESULT CARDS --}}
    <div id="resultCards" style="margin-top: 24px;"></div>

    <div style="height: 5px; width: 100%; display: block; clear: both;"></div>

</div>