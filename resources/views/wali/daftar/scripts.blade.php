@push('scripts')
<script>
    function updateFileName(input) {
        const display = document.getElementById('fileNameDisplay');
        if (input.files && input.files.length > 0) {
            display.textContent = input.files[0].name;
            display.style.color = '#334155';
            display.style.fontWeight = '600';
        } else {
            display.textContent = 'Upload Bukti Transfer';
            display.style.fontWeight = 'normal';
        }
    }

    function closePopup(){
        const popup = document.getElementById('successPopup');
        if(popup) popup.remove();
    }
</script>
@endpush