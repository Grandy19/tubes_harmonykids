@push('scripts')
<script>
    // Toggle lokasi dropdown
    function toggleRideLocation() {
        const box = document.getElementById('rideLocationBox');
        const arrow = document.getElementById('rideArrowIcon');
        const isOpen = box.classList.contains('open');
        box.classList.toggle('open');
        arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        arrow.style.transition = 'transform 0.2s';
    }

    // Pilih kota dan filter driver
    function selectRideCity(city) {
        document.getElementById('rideSelectedCity').innerText = city;
        document.getElementById('rideLocationBox').classList.remove('open');
        document.getElementById('rideArrowIcon').style.transform = 'rotate(0deg)';
        filterDrivers(city);
    }

    // Filter kartu driver berdasarkan area
    function filterDrivers(city) {
        const cards = document.querySelectorAll('.driver-card');
        const emptyState = document.getElementById('emptyState');
        let visible = 0;

        cards.forEach(card => {
            const area = card.getAttribute('data-area');
            if (area === city) {
                card.style.display = 'flex';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        emptyState.style.display = visible === 0 ? 'block' : 'none';
    }

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        const box = document.getElementById('rideLocationBox');
        if (box && !box.contains(e.target)) {
            box.classList.remove('open');
            document.getElementById('rideArrowIcon').style.transform = 'rotate(0deg)';
        }
    });

    // --- MODAL FUNCTIONS ---
    function openDriverModal(card) {
        const name = card.getAttribute('data-name');
        const area = card.getAttribute('data-area');
        const rating = card.getAttribute('data-rating');
        const vehicle = card.getAttribute('data-vehicle');
        const pengalaman = card.getAttribute('data-pengalaman');
        const photo = card.getAttribute('data-photo');

        // Populate Top Header
        document.getElementById('modalBgImg').src = photo;
        document.getElementById('modalNameTop').innerText = name;
        document.getElementById('modalAreaTop').innerText = `Area Layanan: ${area}`;
        document.getElementById('modalRatingTop').innerText = rating;

        // Populate Profil Tab
        document.getElementById('modalProfileImg').src = photo;
        document.getElementById('modalNameInner').innerText = name;

        // Populate Kendaraan Tab
        document.getElementById('modalNameVehicle').innerText = name;
        document.getElementById('modalVehicleType').innerText = vehicle;
        document.getElementById('modalPengalaman').innerText = pengalaman;

        // Default to Profil tab
        switchDriverTab('profil');

        // Show modal and prevent body scroll
        document.getElementById('driverDetailModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeDriverModal() {
        document.getElementById('driverDetailModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    function switchDriverTab(tabId) {
        // Reset Tabs
        document.getElementById('btnTabProfil').classList.remove('active');
        document.getElementById('btnTabKendaraan').classList.remove('active');
        
        // Reset Content
        document.getElementById('tabContentProfil').classList.remove('active');
        document.getElementById('tabContentKendaraan').classList.remove('active');

        // Set Active
        if (tabId === 'profil') {
            document.getElementById('btnTabProfil').classList.add('active');
            document.getElementById('tabContentProfil').classList.add('active');
        } else {
            document.getElementById('btnTabKendaraan').classList.add('active');
            document.getElementById('tabContentKendaraan').classList.add('active');
        }
    }
</script>
@endpush
