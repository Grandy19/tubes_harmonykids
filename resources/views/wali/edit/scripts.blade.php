@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function previewImage(input){
        const file=input.files[0]
        if(!file) return
        const reader=new FileReader()
        reader.onload=e=>document.getElementById('previewImg').src=e.target.result
        reader.readAsDataURL(file)
    }
    
    function updateGenderIcon(sel){
        const icon=document.getElementById('genderIcon')
        icon.className='fa-solid input-icon'
        if(sel.value==='Laki-laki') icon.classList.add('fa-mars')
        else if(sel.value==='Perempuan') icon.classList.add('fa-venus')
        else icon.classList.add('fa-venus-mars')
    }

    // Init icon on load
    window.addEventListener('load', function() {
        const sel = document.querySelector('select[name="jenis_kelamin"]');
        if(sel) updateGenderIcon(sel);
    });

    @if(session('success'))
    Swal.fire({
        icon:'success',
        title:'Berhasil',
        text:'{{ session('success') }}',
        confirmButtonColor:'#0F3974'
    })
    @endif
</script>
@endpush