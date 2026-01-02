<div class="fav-list mt-3">

    @forelse($instansis as $instansi)
        <a href="{{ route('wali.instansi.detail', $instansi->id) }}"
           class="fav-card mb-3 text-decoration-none">

            <div class="fav-inner d-flex gap-3">

                {{-- THUMBNAIL --}}
                <div class="fav-thumb">
                    <img
                        src="{{ $instansi->galleryUtama
                            ? asset('storage/' . $instansi->galleryUtama->image_path)
                            : asset('assets/images/school-placeholder.png') }}"
                        alt="{{ $instansi->nama }}"
                        onerror="this.src='{{ asset('assets/images/school-placeholder.png') }}'">
                </div>

                {{-- CONTENT --}}
                <div class="fav-content flex-grow-1">

                    <div class="fav-title">
                        {{ $instansi->nama }}
                    </div>

                    <div class="fav-meta">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>{{ $instansi->lokasi }}</span>
                    </div>

                    <div class="fav-type">
                        {{ strtoupper($instansi->jenis) }}
                    </div>

                </div>

                {{-- ICON LIKE (UNLIKE) --}}
                <form method="POST"
                      action="{{ route('wali.instansi.like', $instansi->id) }}"
                      onclick="event.stopPropagation(); event.preventDefault(); this.submit();">
                    @csrf
                    <button class="fav-like-btn" type="submit">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                </form>

            </div>
        </a>
    @empty
        <div class="fav-empty">
            <i class="fa-regular fa-heart"></i>
            <p>Belum ada instansi yang disukai</p>
        </div>
    @endforelse

</div>
