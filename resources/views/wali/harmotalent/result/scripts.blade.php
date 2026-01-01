@push('scripts')
<script>
/* =========================
   CACHE DOM (WAJIB)
   ========================= */
const locationDropdown = document.getElementById('locationDropdown');
const sortDropdown = document.getElementById('sortDropdown');
const selectedLocationLabel = document.getElementById('selectedLocationLabel');
const sortLabel = document.getElementById('sortLabel');

/* =========================
   STATE AWAL HARMOTALENT
   ========================= */
let currentState = {
    location: 'Bandung',        // default aman
    category: 'TK/PG',          // default aman
    sort: 'Terbaru',
    bakat: @json($bakat)        // AMAN dari karakter &, spasi, dll
};

/* =========================
   INIT
   ========================= */
document.addEventListener('DOMContentLoaded', () => {
    fetchData();
});

/* =========================
   FETCH DATA
   ========================= */
async function fetchData() {
    const container = document.getElementById('schoolListContainer');

    container.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary"></div>
            <p class="text-muted mt-2 small">Sedang memuat data...</p>
        </div>
    `;

    try {
        const params = new URLSearchParams();
        params.append('bakat', currentState.bakat);
        params.append('jenis', currentState.category);
        params.append('lokasi', currentState.location);

        console.log('FETCH →', `/api/instansi?${params.toString()}`);

        const res = await fetch(`/api/instansi?${params.toString()}`);
        if (!res.ok) throw new Error(res.status);

        let data = await res.json();

        // SORTING
        if (currentState.sort === 'Harga Tertinggi') {
            data.sort((a, b) => b.biaya_pendaftaran - a.biaya_pendaftaran);
        } else if (currentState.sort === 'Harga Terendah') {
            data.sort((a, b) => a.biaya_pendaftaran - b.biaya_pendaftaran);
        } else {
            data.sort((a, b) => b.id - a.id);
        }

        renderList(data);

    } catch (err) {
        console.error(err);
        container.innerHTML = `
            <div class="text-center py-5">
                <p class="text-danger fw-bold">Gagal memuat data</p>
                <button onclick="fetchData()" class="btn btn-link">Coba Lagi</button>
            </div>
        `;
    }
}

/* =========================
   RENDER LIST
   ========================= */
function renderList(data) {
    const container = document.getElementById('schoolListContainer');

    if (!data || data.length === 0) {
        container.innerHTML = `
            <div class="text-center py-10">
                <p class="text-muted fw-semibold">
                    Tidak ada sekolah dengan bakat <b>${currentState.bakat}</b><br>
                    di <b>${currentState.location}</b>
                </p>
            </div>
        `;
        return;
    }

    container.innerHTML = data.map(item => {
        const imgPath = item.image
            ? `/storage/${item.image.replace('public/', '')}`
            : 'https://via.placeholder.com/200x200/E2E8F0/94A3B8?text=No+Image';

        const price = new Intl.NumberFormat('id-ID').format(item.biaya_pendaftaran || 0);

        return `
            <a href="/instansi/${item.id}" class="school-card">
                <img src="${imgPath}" class="sc-img"
                     onerror="this.src='https://via.placeholder.com/200x200/E2E8F0/94A3B8?text=No+Image'">

                <div class="sc-rating">
                    <i class="fa-solid fa-star"></i> ${item.rating || '5.0'}
                </div>

                <div class="sc-content">
                    <div>
                        <div class="sc-title">${item.nama}</div>
                        <div class="sc-price">Rp ${price}</div>
                        <div class="sc-badge">
                            <i class="fa-solid fa-circle-check"></i> ${currentState.bakat}
                        </div>
                    </div>
                    <div class="sc-location">
                        <i class="fa-solid fa-location-dot"></i> ${item.lokasi}
                    </div>
                </div>
            </a>
        `;
    }).join('');
}

/* =========================
   INTERAKSI FILTER
   ========================= */
function toggleLocation() {
    locationDropdown.classList.toggle('active');
    sortDropdown.classList.remove('active');
}

function toggleSort() {
    sortDropdown.classList.toggle('active');
    locationDropdown.classList.remove('active');
}

function selectLocation(val) {
    currentState.location = val;
    selectedLocationLabel.innerText = val;
    toggleLocation();
    fetchData();
}

function selectCategory(val, el) {
    currentState.category = val;
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    fetchData();
}

function selectSort(val) {
    currentState.sort = val;
    sortLabel.innerText = val.replace('Harga ', '');
    toggleSort();
    fetchData();
}

/* =========================
   CLOSE DROPDOWN ON OUTSIDE CLICK
   ========================= */
document.addEventListener('click', e => {
    if (!locationDropdown.contains(e.target)) locationDropdown.classList.remove('active');
    if (!sortDropdown.contains(e.target)) sortDropdown.classList.remove('active');
});
</script>
@endpush
