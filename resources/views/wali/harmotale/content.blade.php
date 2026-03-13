<div class="page-container">

    {{-- LAYER HEADER (Fixed Position) --}}
    <div class="header-layer">
        <x-custom-header title='"HarmoTale"' />
    </div>

    {{-- LAYER CONTENT (Scrollable) --}}
    <div class="content-scroll">
        
        {{-- Intro Text --}}
        <div class="intro-text">
            “Dongeng spesial untuk si kecil,<br>berganti setiap 24 jam.”
        </div>

        {{-- Tale Card (Kartu Cerita) --}}
        <div class="tale-card">
            
            {{-- Gambar Sampul + Overlay Judul --}}
            <div class="tale-img-wrapper">
                {{-- Gambar Sampul Dongeng --}}
                <img src="https://images.unsplash.com/photo-1618588507085-c79565432917?auto=format&fit=crop&q=80&w=800"
                     class="tale-img" alt="The Old Gnome">

                {{-- Judul Overlay di TENGAH gambar --}}
                <div class="tale-title-overlay">
                    The Old Grome's Gift of Friendship
                </div>
            </div>
            
            {{-- Countdown Waktu --}}
            <div class="countdown-pill">
                Berakhir Dalam <span id="countdownTimer">08:23:17</span>
            </div>

            {{-- Tombol Baca --}}
            <a href="{{ route('wali.harmotale.baca') }}" class="btn-baca">Baca Sekarang</a>

        </div>
    </div>

    {{-- AWAN BAWAH — DILUAR CARD, overlap di atas scroll area --}}
    <img src="{{ asset('assets/images/Awan Bawah.png') }}" class="awan-bawah-page" alt="Awan Mask">

</div>
