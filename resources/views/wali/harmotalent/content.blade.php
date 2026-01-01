{{-- WRAPPER UTAMA (Agar Header masuk Frame) --}}
<div class="page-container">
    
    {{-- HEADER --}}
    <div class="header-layer">
        <x-custom-header title="HarmoTalent" />
    </div>

    {{-- CONTENT SCROLLABLE --}}
    <div class="content-scroll">
        <p class="instruction-text">“Pilih salah satu minat & bakat si kecil”</p>
        
        <div class="talent-grid">
            @php
                $talents = [
                    ['name' => 'Seni & Kreativitas', 'img' => 'seni.png'],
                    ['name' => 'Musik', 'img' => 'musik.png'],
                    ['name' => 'Olahraga', 'img' => 'olahraga.png'],
                    ['name' => 'Akademik Dasar', 'img' => 'basic.png'],
                    ['name' => 'Sains & Eksperimen', 'img' => 'sains.png'],
                    ['name' => 'Sosial & Komunikasi', 'img' => 'komunikasi.png'],
                ];
            @endphp

            @foreach($talents as $t)
            <div class="talent-card" onclick="location.href='{{ route('harmotalent.result') }}?bakat={{ urlencode($t['name']) }}'">
                <img src="{{ asset('assets/images/' . $t['img']) }}">
                <div class="overlay">
                    <span class="talent-name">{{ $t['name'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>