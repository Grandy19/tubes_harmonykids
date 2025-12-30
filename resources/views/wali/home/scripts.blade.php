@push('scripts')
<script>
    function toggleDropdown() {
        const wrapper = document.getElementById('locationWrapper');
        const arrow = document.getElementById('arrowIcon');
        wrapper.classList.toggle('active');
        
        if (wrapper.classList.contains('active')) {
            arrow.classList.replace('fa-chevron-down', 'fa-chevron-up');
        } else {
            arrow.classList.replace('fa-chevron-up', 'fa-chevron-down');
        }
    }

    function selectCity(cityName) {
        document.getElementById('selectedCity').innerText = cityName;
        toggleDropdown();
        loadRekomendasi(cityName);
    }

    async function loadRekomendasi(city) {
        const section = document.getElementById('rekomendasiSection');
        const list = document.getElementById('rekomendasiList');
        const btnMore = document.getElementById('btnSelengkapnya');

        section.style.display = 'block';
        list.innerHTML = '<p style="text-align:center; padding:20px;">Memuat data...</p>';

        try {
            const res = await fetch(`/api/instansi?lokasi=${city}&limit=3`);
            const data = await res.json();

            list.innerHTML = '';

            if (data.length === 0) {
                list.innerHTML = '<p style="text-align:center;color:#999;">Tidak ada instansi.</p>';
            }

data.forEach(item => {
                const imgPath = item.image ? `/storage/${item.image}` : 'https://via.placeholder.com/100';
                
                list.innerHTML += `
                    <div class="recom-card" onclick="window.location.href='/instansi/${item.id}'" style="cursor: pointer;">
                        <img src="${imgPath}" class="recom-img">
                        <div class="recom-rating">
                            <i class="fa-solid fa-star"></i> ${item.rating ?? '5.0'}
                        </div>
                        <div class="recom-content">
                            <div>
                                <div class="recom-title">${item.nama}</div>
                                <div class="recom-price">Rp ${Number(item.biaya_pendaftaran).toLocaleString()} /Bulan</div>
                                <div class="recom-badge">
                                    <i class="fa-solid fa-circle-check"></i> Terpopuler
                                </div>
                            </div>
                            <div class="recom-location">
                                <i class="fa-solid fa-location-dot"></i> ${item.lokasi}
                            </div>
                        </div>
                    </div>
                `;
            });

            btnMore.href = `{{ route('wali.harmofind') }}?lokasi=${city}`;
        } catch (e) {
            list.innerHTML = '<p style="text-align:center;color:red;">Gagal memuat data</p>';
            console.error(e);
        }
    }
</script>
@endpush