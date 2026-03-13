@push('scripts')
<script>
    // Smooth scroll behavior sudah aktif dari CSS
    // Tambahan: animasi fade-in saat panel muncul di viewport

    document.addEventListener('DOMContentLoaded', () => {
        const panels = document.querySelectorAll('.panel, .panel-full, .end-card');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        panels.forEach(panel => {
            panel.style.opacity = '0';
            panel.style.transform = 'translateY(20px)';
            panel.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(panel);
        });
    });
</script>
@endpush
