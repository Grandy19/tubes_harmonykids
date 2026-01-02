@push('scripts')
<script>
    function previewImage(input){
        const file = input.files?.[0];
        if(!file) return;

        const preview = document.getElementById('previewImg');
        if(!preview) return;

        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(file);
    }

    function updateGenderIcon(sel){
        const icon = document.getElementById('genderIcon');
        if(!icon) return;

        icon.classList.remove('fa-mars','fa-venus','fa-venus-mars');
        icon.classList.add('fa-solid','input-icon');

        if(sel.value === 'Laki-laki') icon.classList.add('fa-mars');
        else if(sel.value === 'Perempuan') icon.classList.add('fa-venus');
        else icon.classList.add('fa-venus-mars');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const sel = document.querySelector('select[name="jenis_kelamin"]');
        if(sel) updateGenderIcon(sel);
    });

    // ===============================
    // 🔥 INI YANG HILANG SELAMA INI
    // ===============================
    function closePopup(){
        const popup = document.getElementById('successPopup');
        if(popup){
            popup.remove(); // popup HILANG total
        }
    }
</script>
@endpush
