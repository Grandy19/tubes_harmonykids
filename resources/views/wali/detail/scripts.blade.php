@push('scripts')
<script>
    function switchTab(id, el) {
        document.querySelectorAll('.tab-panel').forEach(div => div.style.display = 'none');
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById(id).style.display = 'block';
        el.classList.add('active');
    }
</script>
@endpush