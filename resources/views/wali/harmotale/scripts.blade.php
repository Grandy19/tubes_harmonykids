@push('scripts')
<script>
    // Countdown REAL: hitung mundur sampai 23:59:59 hari ini
    function startCountdown() {
        function updateTimer() {
            const now = new Date();

            // Target: akhir hari ini pukul 23:59:59
            const endOfDay = new Date(
                now.getFullYear(),
                now.getMonth(),
                now.getDate(),
                23, 59, 59
            );

            // Sisa waktu dalam detik
            let diff = Math.floor((endOfDay - now) / 1000);

            if (diff < 0) diff = 0;

            const h = Math.floor(diff / 3600);
            const m = Math.floor((diff % 3600) / 60);
            const s = diff % 60;

            const display = 
                String(h).padStart(2, '0') + ':' +
                String(m).padStart(2, '0') + ':' +
                String(s).padStart(2, '0');

            const timerEl = document.getElementById('countdownTimer');
            if (timerEl) {
                timerEl.innerText = display;
            }
        }

        // Jalankan sekali langsung, lalu tiap detik
        updateTimer();
        setInterval(updateTimer, 1000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        startCountdown();
    });
</script>
@endpush
