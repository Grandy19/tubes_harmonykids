@push('scripts')
<script>
    // Logic Checkbox Visual Saja
    let agreed = false;

    function toggleAgree() {
        agreed = !agreed;
        const visual = document.getElementById('chkBoxVisual');
        
        if(agreed) {
            visual.classList.add('checked');
        } else {
            visual.classList.remove('checked');
        }
    }

    // Validasi sebelum form disubmit browser
    function validateForm() {
        if (!agreed) {
            // Kita pake SweetAlert bawaan lu kalau ada, atau alert biasa
            if(typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Anda harus menyetujui ketentuan layanan!',
                    confirmButtonColor: '#0F3974'
                });
            } else {
                alert('Anda harus menyetujui ketentuan HarmonyKids');
            }
            return false; // Stop submit
        }
        return true; // Lanjut submit ke Controller
    }
</script>
@endpush