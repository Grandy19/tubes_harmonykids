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
    const imgPath = i.gallery_utama
        ? `/storage/${i.gallery_utama.image_path}`
        : 'https://via.placeholder.com/150';
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