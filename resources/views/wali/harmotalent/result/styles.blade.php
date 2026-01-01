@push('styles')
<style>
    /* --- 1. STRUKTUR UTAMA (FRAME HP) --- */
    .page-container {
        position: relative; 
        width: 100%;
        height: 100vh; 
        background: #F8FAFC; 
        overflow: hidden;
    }

    /* --- LAYOUT UTAMA --- */
    .header-layer { 
        position: absolute; top: 0; left: 0; right: 0; z-index: 50; 
        height: 120px; pointer-events: none;
    }
    .header-layer > * { pointer-events: auto; }

    /* CONTENT SCROLL (SCROLLABLE) */
    .content-scroll {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        
        /* PERBAIKAN UTAMA DI SINI */
        /* Ubah dari 240px menjadi 130px */
        padding-top: 240px; 
        
        padding-left: 0; 
        padding-right: 0; 
        
        /* Kembalikan padding-bottom agar konten tidak tertutup nav bar bawah */
      
        
        overflow-y: auto; 
        z-index: 10;
        background: #F8FAFC;
        
        /* Hilangkan Scrollbar */
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-scroll::-webkit-scrollbar { display: none; }

    /* Wrapper Filter di dalam Scroll */
    .filter-area-scroll {
        padding: 0 24px;
        position: relative; 
        z-index: 20;
        margin-bottom: 10px; 
    }

    /* ... (Sisa CSS lainnya TETAP SAMA seperti Dropdown Lokasi, Tombol Kategori, dll) ... */
    
    /* DROPDOWN LOKASI */
    .location-box { background: white; border-radius: 20px; box-shadow: 0 10px 25px rgba(53, 119, 229, 0.1); position: relative; z-index: 50; border: 1px solid #F1F5F9; cursor: pointer; transition: 0.2s; }
    .location-box:active { transform: scale(0.98); }
    .loc-header { padding: 18px 24px; display: flex; align-items: center; }
    .loc-list { display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border-radius: 0 0 20px 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.1); border-top: 1px solid #f0f0f0; z-index: 100; overflow: hidden; margin-top: -10px; padding-top: 10px; }
    .loc-item { padding: 16px 24px; font-weight: 600; font-size: 14px; color: #2A2A2A; cursor: pointer; transition: background 0.2s; border-bottom: 1px solid #f8f9fa; }
    .loc-item:last-child { border-bottom: none; }
    .loc-item:hover { background: #F8FAFC; color: #3577E5; }
    .location-box.active .loc-list { display: block; }
    .location-box.active { border-bottom-left-radius: 0; border-bottom-right-radius: 0; }

    /* TOMBOL KATEGORI */
    .cat-btn { background: white; color: #3577E5; padding: 12px 18px; min-width: 90px; text-align: center; border-radius: 12px; font-weight: 700; font-size: 13px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); cursor: pointer; transition: all 0.2s; border: 1px solid transparent; text-decoration: none; display: inline-block; }
    .cat-btn:active { transform: scale(0.95); }
    .cat-btn.active { background: #3577E5; color: white; box-shadow: 0 6px 15px rgba(53, 119, 229, 0.3); }

    /* DROPDOWN SORTIR */
    .sort-box { background: white; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); position: relative; min-width: 160px; z-index: 40; cursor: pointer; }
    .sort-header { padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; }
    .sort-list { display: none; position: absolute; top: 105%; right: 0; width: 100%; background: white; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); overflow: hidden; z-index: 100; }
    .sort-item { padding: 12px 14px; font-size: 13px; cursor: pointer; border-bottom: 1px solid #f9f9f9; color: #333; font-weight: 500; display: block; text-decoration: none; }
    .sort-item:last-child { border-bottom: none; }
    .sort-item:hover { background: #f0f7ff; color: #3577E5; }
    .sort-box.active .sort-list { display: block; animation: fadeIn 0.2s; }

    /* STYLE CARD SEKOLAH */
    .school-card { display: flex; position: relative; background: white; border-radius: 16px; padding: 12px; margin: 0 24px 16px 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); align-items: flex-start; border: 1px solid #f8f9fa; cursor: pointer; transition: transform 0.1s; text-decoration: none !important; color: inherit !important; }
    .school-card:active { transform: scale(0.98); }
    .sc-img { width: 100px; height: 100px; border-radius: 12px; object-fit: cover; flex-shrink: 0; background: #eee; }
    .sc-content { flex: 1; padding-left: 14px; display: flex; flex-direction: column; justify-content: space-between; min-height: 100px; }
    .sc-title { font-weight: 800; font-size: 15px; color: #3577E5; margin-bottom: 2px; line-height: 1.2; padding-right: 40px; }
    .sc-price { font-weight: 700; font-size: 14px; color: #3577E5; margin-bottom: 8px; }
    .sc-badge { display: inline-flex; align-items: center; background-color: #4CD964; color: white; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px; width: fit-content; margin-bottom: 8px; }
    .sc-badge i { margin-right: 5px; font-size: 11px; }
    .sc-location { font-size: 12px; color: #666; font-weight: 600; display: flex; align-items: center; }
    .sc-location i { color: #3577E5; margin-right: 6px; font-size: 14px; }
    .sc-rating { position: absolute; top: 12px; right: 12px; background: white; border: 1px solid #f0f0f0; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-radius: 20px; padding: 4px 8px; display: flex; align-items: center; font-weight: 800; font-size: 12px; color: #333; }
    .sc-rating i { color: #FFC107; margin-right: 4px; font-size: 11px; }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush