<div id="fasilitas" class="tab-panel">
    <div class="section-label">Fasilitas Ruangan</div>
    <div class="fas-grid">
        @forelse($instansi->galleries->where('category', 'ruangan') as $fas)
            <div class="fas-item">
                <img src="{{ asset('storage/'.$fas->image_path) }}">
                <div class="fas-overlay">{{ $fas->caption ?? 'Ruangan' }}</div>
            </div>
        @empty
            <div class="fas-item">
                <img src="https://via.placeholder.com/150?text=Kelas">
                <div class="fas-overlay">Ruang Kelas</div>
            </div>
        @endforelse
    </div>

    <div class="section-label">Guru & Staff</div>
    <div class="fas-grid">
        @forelse($instansi->galleries->where('category', 'sdm') as $sdm)
            <div class="fas-item">
                <img src="{{ asset('storage/'.$sdm->image_path) }}">
                <div class="fas-overlay">{{ $sdm->caption ?? 'Guru' }}</div>
            </div>
        @empty
            <div class="fas-item">
                 <img src="https://via.placeholder.com/150?text=Guru">
                 <div class="fas-overlay">Guru</div>
            </div>
        @endforelse
    </div>
</div>