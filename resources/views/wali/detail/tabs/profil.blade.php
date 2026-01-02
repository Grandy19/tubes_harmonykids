<div id="profil" class="tab-panel active">
    <div class="photo-grid">
        @forelse($instansi->galleryProfil->take(2) as $img)
            <img src="{{ asset('storage/'.$img->image_path) }}">
        @empty
            <img src="https://via.placeholder.com/150">
            <img src="https://via.placeholder.com/150">
        @endforelse
    </div>

    <div class="section-label">Sekilas Tentang Kami</div>
    <div class="desc-text">
        {{ $instansi->profile->sekilas_tentang_kami ?? 'Instansi ini berkomitmen memberikan pendidikan terbaik dengan lingkungan yang aman dan nyaman.' }}
    </div>

    <div class="section-label">Program Unggulan</div>
    @php
         $programs = $instansi->profile && $instansi->profile->program_pembelajaran 
            ? explode(',', $instansi->profile->program_pembelajaran)
            : ['Sensory Play', 'Calistung Dasar', 'Motorik Halus & Kasar'];
    @endphp
    @foreach($programs as $p)
        <div class="prog-card">
            <i class="fa-solid fa-circle-check" style="margin-right: 10px;"></i>
            <span>{{ trim($p) }}</span>
        </div>
    @endforeach
</div>