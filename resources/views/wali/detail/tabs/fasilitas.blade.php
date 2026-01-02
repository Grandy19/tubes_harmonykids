<div id="fasilitas" class="tab-panel">

    {{-- FASILITAS RUANGAN --}}
    <div class="section-label">Fasilitas Ruangan</div>
    <div class="fas-grid">
        @forelse($instansi->galleryFasilitas as $fas)
            <div class="fas-item">
                <img src="{{ asset('storage/'.$fas->image_path) }}">
                <div class="fas-overlay">
                    {{ $fas->caption ?? 'Fasilitas' }}
                </div>
            </div>
        @empty
            <div class="fas-item">
                <img src="https://via.placeholder.com/150?text=Fasilitas">
                <div class="fas-overlay">Fasilitas</div>
            </div>
        @endforelse
    </div>

    {{-- GURU & STAFF --}}
    <div class="section-label">Guru & Staff</div>
    <div class="fas-grid">
        @forelse($instansi->gallerySDM as $sdm)
            <div class="fas-item">
                <img src="{{ asset('storage/'.$sdm->image_path) }}">
                <div class="fas-overlay">
                    {{ $sdm->caption ?? 'Guru & Staff' }}
                </div>
            </div>
        @empty
            <div class="fas-item">
                <img src="https://via.placeholder.com/150?text=Guru">
                <div class="fas-overlay">Guru & Staff</div>
            </div>
        @endforelse
    </div>

</div>
