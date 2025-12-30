{{-- DEBUG_MARKER: HARMOVIEW_SPACING_FIX --}}

<x-mobile-app title="HarmoView" :withNavbar="true">

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<style>
    /* --- LAYOUT GLOBAL --- */
    .header-layer { 
        position: absolute; top: 0; left: 0; right: 0; 
        z-index: 50; 
        pointer-events: none; 
    }
    
    .header-layer > * { pointer-events: auto; }

    .content-scroll { 
        padding-top: 250px; 
        padding-left: 24px; 
        padding-right: 24px; 
        /* PERBAIKAN: Tambah padding bawah sedikit, spacer nanti dikurangi */
        padding-bottom: 20px; 
        min-height: 100vh; 
        background: #F9FAFB;
        overflow-y: auto; 
        position: relative;
        -ms-overflow-style: none; scrollbar-width: none;  
    }
    .content-scroll::-webkit-scrollbar { display: none; }

    .label-center {
        font-weight: 800; color: #3577E5; font-size: 14px;
        text-align: center; margin: 12px 0;
        text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.8;
    }

    .search-pill {
        position: relative;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        min-height: 55px;
        display: flex;
        align-items: center;
        padding: 0 15px;
        border: 1px solid #f0f0f0;
    }

    .search-icon { font-size: 18px; color: #aaa; margin-right: 10px; z-index: 5; }

    .dot-indicator { 
        width: 14px; height: 14px; border-radius: 50%; margin-left: 10px; flex-shrink: 0; z-index: 5;
    }
    .dot-blue { background: #2E7CF6; }
    .dot-red { background: #EA4335; }

    /* Choices JS Styling */
    .choices { flex: 1; margin-bottom: 0; font-size: 14px; font-weight: 600; color: #333; overflow: visible; }
    .choices__inner { border: none !important; background-color: transparent !important; padding: 0 !important; min-height: auto !important; display: flex; align-items: center; }
    .choices__input { background-color: transparent !important; margin-bottom: 0 !important; font-size: 14px !important; color: #333 !important; font-weight: 600 !important; }
    .choices__placeholder { opacity: 0.5; color: #999; }
    .choices__list--dropdown { background: #ffffff; border: none; border-radius: 12px; box-shadow: 0 10px 30px rgba(53, 119, 229, 0.15); margin-top: 10px; padding: 5px; z-index: 100 !important; }
    .choices__list--dropdown .choices__item { border-radius: 8px; font-size: 13px; padding: 10px 14px; margin-bottom: 2px; color: #555; }
    .choices__list--dropdown .choices__item--selectable.is-highlighted { background-color: #F0F7FF; color: #3577E5; font-weight: 700; }
    .choices[data-type*="select-one"]::after { display: none; }

    /* Result Cards */
    .chart-card { background: white; border-radius: 24px; padding: 20px; margin-top: 24px; box-shadow: 0 6px 20px rgba(0,0,0,0.05); display: none; }
    .chart-title { text-align: center; color: #3577E5; font-weight: 700; font-size: 16px; margin-bottom: 20px; }
    
    .result-card { display: flex; background: white; border-radius: 20px; padding: 12px; margin-top: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); position: relative; border: 1px solid #f8f9fa; cursor: pointer; }
    .result-card img { width: 90px; height: 90px; border-radius: 16px; object-fit: cover; margin-right: 14px; background: #eee; }
    .result-content { flex: 1; display: flex; flex-direction: column; justify-content: center; }
    .result-title { font-weight: 800; color: #3577E5; font-size: 15px; margin-bottom: 4px; }
    .result-price { font-weight: 700; color: #3577E5; font-size: 14px; margin-bottom: 6px; }
    .badge-pill { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700; color: white; width: fit-content; margin-bottom: 6px; }
    .bg-green { background: #4CD964; } .bg-yellow { background: #FFC107; }
    .result-loc { font-size: 11px; color: #666; font-weight: 600; display: flex; align-items: center; }
    .result-loc i { color: #3577E5; margin-right: 5px; font-size: 13px; }
    .rating-pill { position: absolute; top: 12px; right: 12px; background: #fff; border: 1px solid #eee; padding: 4px 8px; border-radius: 10px; font-size: 12px; font-weight: 800; color: #333; display: flex; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    .rating-pill i { color: #FFC107; margin-right: 4px; }
</style>
@endpush

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

    {{-- 
       PERBAIKAN JARAK BAWAH:
       Dikurangi dari 150px menjadi 80px. 
       Ini cukup untuk menghindari tertutup navbar, tapi tidak terlalu jauh.
    --}}
    <div style="height: 5px; width: 100%; display: block; clear: both;"></div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
const resultCards  = document.getElementById('resultCards');
const compareChart = document.getElementById('compareChart');
let chart = null;
let choice1, choice2;

// CONFIG
const choicesConfig = {
    searchEnabled: true, searchPlaceholderValue: 'Cari nama sekolah...',
    itemSelectText: '', shouldSort: false, position: 'bottom', 
    placeholder: true, placeholderValue: 'Pilih Instansi', noResultsText: 'Tidak ditemukan',
};

document.addEventListener('DOMContentLoaded', async () => {
    choice1 = new Choices('#instansi1', choicesConfig);
    choice2 = new Choices('#instansi2', choicesConfig);

    try {
        const res = await fetch('/api/instansi', { headers: { 'Accept': 'application/json' } });
        if (!res.ok) throw new Error('Gagal load data');
        
        const instansiList = await res.json();
        const options = instansiList.map(i => ({
            value: i.id, label: i.nama, customProperties: { biaya: i.biaya_pendaftaran }
        }));

        choice1.setChoices(options, 'value', 'label', true);
        choice2.setChoices(options, 'value', 'label', true);

        document.getElementById('instansi1').addEventListener('change', compare);
        document.getElementById('instansi2').addEventListener('change', compare);
    } catch (e) { console.error(e); }
});

async function compare() {
    const id1 = choice1.getValue(true);
    const id2 = choice2.getValue(true);

    if (!id1 || !id2) return;
    if (id1 === id2) { 
        alert('Pilih dua instansi yang berbeda'); 
        choice2.removeActiveItems(); 
        return; 
    }

    const url = window.location.origin + '/harmoview/compare?ids=' + id1 + ',' + id2;

    try {
        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) { alert('Gagal mengambil data'); return; }
        
        const data = await res.json();
        if (!Array.isArray(data) || data.length !== 2) { alert('Data invalid'); return; }
        
        renderChart(data);
        renderCards(data);
        document.getElementById('chartSection').scrollIntoView({ behavior: 'smooth', block: 'start' });
    } catch (e) { console.error(e); }
}

function renderChart(data) {
    document.getElementById('chartSection').style.display = 'block';
    const d1 = data[0];
    const d2 = data[1];
    if (chart) chart.destroy();

    const norm = (val, max) => Math.min(Math.max((val / max) * 4 + 1, 1), 5);
    const normBiaya = (biaya) => Math.min(Math.max(6 - (biaya / 1000000), 1), 5);

    chart = new Chart(compareChart, {
        type: 'line',
        data: {
            labels: ['Fasilitas', 'Jam Ops', 'Program', 'Biaya Hemat'],
            datasets: [
                {
                    label: d1.nama,
                    data: [norm(d1.jumlah_fasilitas, 10), norm(d1.jam_operasional, 12), norm(d1.jumlah_program, 5), normBiaya(d1.biaya)],
                    borderColor: '#2E7CF6', backgroundColor: 'rgba(46, 124, 246, 0.1)',
                    tension: 0.4, pointRadius: 5, borderWidth: 3, fill: true
                },
                {
                    label: d2.nama,
                    data: [norm(d2.jumlah_fasilitas, 10), norm(d2.jam_operasional, 12), norm(d2.jumlah_program, 5), normBiaya(d2.biaya)],
                    borderColor: '#EA4335', backgroundColor: 'rgba(234, 67, 53, 0.1)',
                    tension: 0.4, pointRadius: 5, borderWidth: 3, fill: true
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: true, position: 'bottom', labels: { usePointStyle: true } } },
            scales: { y: { min: 0, max: 6, display: false }, x: { grid: { display: false }, ticks: { font: { size: 11, weight: 'bold' }, color: '#333' } } }
        }
    });
}

function renderCards(data) {
    resultCards.innerHTML = '';
    const cheapestIndex = data[0].biaya < data[1].biaya ? 0 : 1;

    data.forEach((i, index) => {
        const imgPath = i.image ? `/storage/${i.image}` : 'https://via.placeholder.com/150';
        let badgeHTML = (index === cheapestIndex)
            ? `<div class="badge-pill bg-green"><i class="fa-solid fa-thumbs-up" style="margin-right:4px"></i> Hemat</div>`
            : `<div class="badge-pill bg-yellow"><i class="fa-solid fa-tag" style="margin-right:4px"></i> Pilihan</div>`;

        resultCards.insertAdjacentHTML('beforeend', `
            <div class="result-card" onclick="window.location.href='/instansi/${i.id}'">
                <img src="${imgPath}">
                <div class="rating-pill"><i class="fa-solid fa-star"></i> 5.0</div>
                <div class="result-content">
                    <div class="result-title">${i.nama}</div>
                    <div class="result-price">Rp ${Number(i.biaya).toLocaleString('id-ID')}</div>
                    ${badgeHTML}
                    <div class="result-loc"><i class="fa-solid fa-location-dot"></i> ${i.lokasi ? i.lokasi : 'Bandung'}</div>
                </div>
            </div>
        `);
    });
}
</script>
@endpush
</x-mobile-app>