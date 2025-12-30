@push('scripts')
<script>
    // Logic Toggle Password
    function togglePass() {
        const input = document.getElementById('password')
        const icon = document.querySelector('.password-toggle')
        
        if (input.type === 'password') {
            input.type = 'text'
            icon.classList.remove('fa-eye-slash')
            icon.classList.add('fa-eye')
        } else {
            input.type = 'password'
            icon.classList.remove('fa-eye')
            icon.classList.add('fa-eye-slash')
        }
    }
</script>
@endpush