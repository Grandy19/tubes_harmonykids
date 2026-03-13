<div class="webtoon-page">

    {{-- ===== TOP HEADER JUDUL DONGENG ===== --}}
    <div class="webtoon-header">

        {{-- Tombol back ke halaman HarmoTale utama --}}
        <a href="{{ route('wali.harmotale') }}" class="webtoon-back-btn">
            <i class="fa-solid fa-chevron-left"></i>
        </a>

        <div style="display:flex; flex-direction:column; align-items:flex-start; flex:1; padding-right: 110px; padding-left: 30px;">
            <div class="webtoon-kelas">Reading Activity</div>
            <div class="webtoon-judul-besar">The Kind<br>Dragon and the<br>Brave Princess</div>
            <div class="webtoon-subtitle">Teacher Lily's Class</div>
        </div>

        {{-- Gambar dekorasi castle di pojok kanan --}}
        <img src="https://cdn-icons-png.flaticon.com/512/3082/3082403.png"
             class="webtoon-header-img" alt="Castle">
        <img src="https://cdn-icons-png.flaticon.com/512/3082/3082534.png"
             class="webtoon-header-dragon" alt="Dragon" style="top:4px; right:4px; width:55px;">
    </div>

    {{-- ===== STRIP PANEL WEBTOON ===== --}}
    <div class="webtoon-strip">

        {{-- PANEL 1: Gambar castle besar KIRI + Teks "Once Upon a Time" KANAN --}}
        <div class="panel panel-a">
            <div class="panel-img-wrap">
                <img src="https://cdn-icons-png.flaticon.com/512/3082/3082403.png" alt="Castle" style="height:220px; object-fit:contain; object-position:bottom;">
            </div>
            <div class="panel-text-wrap">
                <div class="once-badge">
                    <div class="cursive-title">Once Upon a Time..</div>
                    <p>..in a faraway land, there lived a beautiful princess named Lily. She lived in a grand, magical castle.</p>
                </div>
            </div>
        </div>

        <div class="panel-divider"></div>

        {{-- PANEL 2: Teks KIRI + Gambar penyihir KANAN --}}
        <div class="panel panel-b">
            <div class="panel-img-wrap">
                <img src="https://cdn-icons-png.flaticon.com/512/4408/4408449.png" alt="Witch" style="height:200px; object-fit:contain; object-position:bottom;">
            </div>
            <div class="panel-text-wrap">
                <p>One day, a wicked witch cast a spell on Princess Lily and trapped her inside an unknown castle, far, far away from home.</p>
            </div>
        </div>

        <div class="panel-divider"></div>

        {{-- PANEL 3: Gambar princess KIRI + Teks KANAN --}}
        <div class="panel panel-c">
            <div class="panel-img-wrap">
                <img src="https://cdn-icons-png.flaticon.com/512/6858/6858562.png" alt="Princess" style="height:210px; object-fit:contain; object-position:bottom;">
            </div>
            <div class="panel-text-wrap">
                <p>The castle was guarded by a fearsome dragon named Draco. People thought Draco was mean and evil, but deep inside he had a kind heart.</p>
            </div>
        </div>

        <div class="panel-divider"></div>

        {{-- PANEL 4: Teks KIRI + Gambar castle menara KANAN --}}
        <div class="panel panel-d">
            <div class="panel-img-wrap">
                <img src="https://cdn-icons-png.flaticon.com/512/3082/3082535.png" alt="Tower" style="height:200px; object-fit:contain; object-position:bottom;">
            </div>
            <div class="panel-text-wrap">
                <p>Princess Lily was locked in the highest tower. Every night she cried, wishing someone would come to help her escape.</p>
            </div>
        </div>

        <div class="panel-divider"></div>

        {{-- PANEL 5: Full width - adegan penting "Draco speaks" --}}
        <div class="panel-full">
            <div class="cursive-title">"Don't be afraid.."</div>
            <img src="https://cdn-icons-png.flaticon.com/512/3082/3082534.png" alt="Dragon" style="width:100px;">
            <p>One morning, Draco spoke gently to Lily: <em>"I am not your enemy. I was forced to guard this castle by the wicked witch. Let us help each other!"</em></p>
        </div>

        <div class="panel-divider"></div>

        {{-- PANEL 6: Gambar princess + dragon bersama KIRI + Teks KANAN --}}
        <div class="panel panel-e">
            <div class="panel-img-wrap" style="flex-direction:column; gap:4px;">
                <img src="https://cdn-icons-png.flaticon.com/512/6858/6858562.png" alt="Princess" style="height:120px; object-fit:contain; object-position:bottom;">
                <img src="https://cdn-icons-png.flaticon.com/512/3082/3082534.png" alt="Dragon" style="height:90px; object-fit:contain; object-position:bottom;">
            </div>
            <div class="panel-text-wrap">
                <p>Princess Lily and Draco became friends! Together, they made a plan to break the witch's spell and escape from the castle.</p>
            </div>
        </div>

        <div class="panel-divider"></div>

        {{-- PANEL 7: Teks KIRI + Gambar penyihir & cahaya KANAN --}}
        <div class="panel panel-f">
            <div class="panel-img-wrap">
                <img src="https://cdn-icons-png.flaticon.com/512/4408/4408449.png" alt="Witch defeated" style="height:180px; object-fit:contain; object-position:bottom; filter: hue-rotate(120deg);">
            </div>
            <div class="panel-text-wrap">
                <p>With courage and kindness, Lily and Draco faced the witch together. The power of friendship broke the spell, and a bright light filled the castle!</p>
            </div>
        </div>

        <div class="panel-divider"></div>

        {{-- PANEL 8: Full width - HAPPY ENDING --}}
        <div class="panel-full">
            <div class="cursive-title">~ The End ~</div>
            <div style="display:flex; gap:10px; align-items:flex-end; justify-content:center;">
                <img src="https://cdn-icons-png.flaticon.com/512/6858/6858562.png" alt="Princess" style="width:75px;">
                <img src="https://cdn-icons-png.flaticon.com/512/3082/3082534.png" alt="Dragon" style="width:75px;">
            </div>
            <p>Princess Lily returned home safely, and Draco was finally free. They remained the best of friends forever and ever.</p>
            <p style="font-size:11px; color:#5AACB0; margin-top:4px;"><strong>Pesan moral:</strong> Kebaikan dan persahabatan mengalahkan segalanya! 🌟</p>
        </div>

    </div>

    {{-- ===== KARTU SELESAI ===== --}}
    <div class="end-card">
        <h4>🎉 Selesai Membaca!</h4>
        <p>Kamu telah menyelesaikan dongeng hari ini.<br>Sampai jumpa besok dengan cerita baru!</p>
        <a href="{{ route('wali.harmotale') }}" class="btn-selesai">Kembali ke HarmoTale</a>
    </div>

</div>
