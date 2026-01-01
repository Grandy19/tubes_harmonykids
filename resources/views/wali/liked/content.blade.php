<div class="page-container">
    
    {{-- HEADER --}}
    <div class="header-layer">
        {{-- Gunakan Header Polos atau Custom sesuai kebutuhan --}}
        <div class="w-full h-[80px] bg-white flex items-center px-6 shadow-sm">
            <div class="font-extrabold text-[#1E293B] text-lg">Disukai</div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content-scroll">
        
        @forelse($likedInstansis as $item)
            @php
                // Handle Gambar
                $imgPath = $item->image 
                    ? asset('storage/' . str_replace('public/', '', $item->image)) 
                    : asset('assets/images/sekolah_default.png');
                
                $price = number_format($item->biaya_pendaftaran, 0, ',', '.');
            @endphp

            {{-- Card Link ke Detail --}}
            <a href="{{ route('wali.instansi.detail', $item->id) }}" class="school-card" id="card-{{ $item->id }}">
                
                {{-- Gambar --}}
                <img src="{{ $imgPath }}" class="sc-img" onerror="this.src='https://via.placeholder.com/200?text=Sekolah'">
                
                {{-- Tombol UNLIKE (Pojok Kanan Atas) --}}
                {{-- event.preventDefault() penting agar tidak masuk ke halaman detail saat klik hati --}}
                <button class="btn-unlike" onclick="unlikeSchool(event, {{ $item->id }})">
                    <i class="fa-solid fa-heart"></i>
                </button>

                <div class="sc-content">
                    <div>
                        <div class="sc-title">{{ $item->nama }}</div>
                        
                        {{-- Rating Kecil --}}
                        <div class="rating-chip">
                            <i class="fa-solid fa-star text-yellow-400 mr-1"></i> {{ $item->rating ?? '5.0' }}
                        </div>

                        <div class="sc-price">Rp {{ $price }}</div>
                    </div>

                    <div class="sc-location">
                        <i class="fa-solid fa-location-dot"></i> {{ $item->lokasi }}
                    </div>
                </div>
            </a>

        @empty
            {{-- EMPTY STATE (Jika Kosong) --}}
            <div class="flex flex-col items-center justify-center pt-20 px-6 text-center">
                <img src="{{ asset('assets/images/empty-like.png') }}" 
                     class="w-[150px] opacity-60 mb-4" 
                     onerror="this.src='https://via.placeholder.com/150/e2e8f0/94a3b8?text=Belum+Ada+Like'">
                
                <h3 class="font-bold text-[#1E293B] text-lg mb-2">Belum ada yang disukai</h3>
                <p class="text-[#64748B] text-sm leading-relaxed">
                    Anda belum menyimpan sekolah apapun. <br>
                    Cari sekolah favorit Anda dan tekan tombol hati!
                </p>
                
                <a href="{{ route('wali.harmofind') }}" 
                   class="mt-6 px-6 py-3 bg-[#3577E5] text-white rounded-xl font-bold text-sm shadow-lg shadow-blue-200">
                    Cari Sekolah Sekarang
                </a>
            </div>
        @endforelse

    </div>
</div>