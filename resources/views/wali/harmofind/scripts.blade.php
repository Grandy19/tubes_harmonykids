@push('scripts')
<script>
    // State Awal
    let currentState = {
        location: '{{ $lokasi ?? "Bandung" }}',
        category: '{{ $kategori ?? "TK/PG" }}',
        sort: '{{ $sort ?? "Terbaru" }}',
        bakat: '{{ $bakat ?? "" }}'
    };

    document.addEventListener('DOMContentLoaded', fetchData);

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
            if (currentState.bakat) params.append('bakat', currentState.bakat);
            params.append('jenis', currentState.category);
            params.append('lokasi', currentState.location);

            const res = await fetch(`/api/instansi?${params.toString()}`);
            if (!res.ok) throw new Error(res.status);

            let data = await res.json();

            // Sorting
            if (currentState.sort === 'Harga Tertinggi') {
                data.sort((a, b) => b.biaya_pendaftaran - a.biaya_pendaftaran);
            } else if (currentState.sort === 'Harga Terendah') {
                data.sort((a, b) => a.biaya_pendaftaran - b.biaya_pendaftaran);
            } else {
                data.sort((a, b) => b.id - a.id);
            }

            renderList(data);

        } catch (error) {
            container.innerHTML = `
                <div class="text-center py-5">
                    <p class="text-danger fw-bold">Gagal memuat data</p>
                    <button onclick="fetchData()" class="btn btn-link">Coba Lagi</button>
                </div>
            `;
        }
    }

    function renderList(data) {
        const container = document.getElementById('schoolListContainer');

        if (!data || data.length === 0) {
            container.innerHTML = `
                <div class="empty-state text-center py-10">
                    <img src="https://via.placeholder.com/150/e2e8f0/94a3b8?text=Tidak+Ditemukan"
                         class="empty-img">
                    <p class="text-muted fw-semibold mt-3">
                        Tidak ada sekolah di <b>${currentState.location}</b><br>
                        kategori <b>${currentState.category}</b>
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

            let badgeText = '';
            if (currentState.sort === 'Harga Tertinggi') badgeText = 'Fasilitas Premium';
            else if (currentState.sort === 'Harga Terendah') badgeText = 'Harga Hemat';
            else badgeText = 'Baru Ditambahkan';

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
                                <span class="badge-pill">
                                    <i class="fa-solid fa-circle-check"></i> ${badgeText}
                                </span>
                            </div>
                        </div>

                        <div class="sc-location">
                            <i class="fa-solid fa-location-dot"></i>
                            ${item.lokasi || currentState.location}
                        </div>
                    </div>
                </a>
            `;
        }).join('');
    }

    /* EVENT HANDLERS */
    function toggleLocation() {
        document.getElementById('locationDropdown').classList.toggle('active');
        document.getElementById('sortDropdown').classList.remove('active');
    }

    function selectLocation(val) {
        currentState.location = val;
        document.getElementById('selectedLocationLabel').innerText = val;
        toggleLocation();
        fetchData();
    }

    function selectCategory(val, el) {
        currentState.category = val;
        document.querySelectorAll('.cat-btn').forEach(btn => btn.classList.remove('active'));
        el.classList.add('active');
        fetchData();
    }

    function toggleSort() {
        document.getElementById('sortDropdown').classList.toggle('active');
        document.getElementById('locationDropdown').classList.remove('active');
    }

    function selectSort(value, label = value) {
        currentState.sort = value;
        document.getElementById('sortLabel').innerText = label;
        toggleSort();
        fetchData();
    }

    document.addEventListener('click', e => {
        if (!locationDropdown.contains(e.target)) locationDropdown.classList.remove('active');
        if (!sortDropdown.contains(e.target)) sortDropdown.classList.remove('active');
    });
</script>
@endpush
