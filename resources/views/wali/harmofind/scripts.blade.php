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
        
        container.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="text-gray-400 text-sm mt-2">Sedang memuat data...</p>
            </div>
        `;

        try {
            const params = new URLSearchParams();
            params.append('lokasi', currentState.location); 
            params.append('jenis', currentState.category);

            console.log("Fetching: /api/instansi?" + params.toString());

            const res = await fetch(`/api/instansi?${params.toString()}`);
            let data = await res.json();

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
                <div class="school-card" onclick="window.location.href='/instansi/${item.id}'">
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