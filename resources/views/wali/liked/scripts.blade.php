@push('scripts')
<script>
    function unlikeSchool(event, id) {
        // Mencegah link <a> tereksekusi (pindah halaman)
        event.preventDefault();
        event.stopPropagation();

        // Konfirmasi (Opsional)
        if(!confirm('Hapus dari daftar disukai?')) return;

        // Efek Visual Langsung (Optimistic UI)
        const card = document.getElementById(`card-${id}`);
        if(card) {
            card.style.transition = 'all 0.3s';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';
            setTimeout(() => card.remove(), 300);
        }

        // TODO: Panggil AJAX ke Backend untuk menghapus like
        /*
        fetch(`/api/like/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
        */
       console.log('Unliked ID:', id);
    }
</script>
@endpush