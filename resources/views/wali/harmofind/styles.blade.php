@push('styles')
<style>
    /* --- 1. TAMBAHKAN INI: CONTAINER UTAMA --- */
    /* Penting agar layout terkunci di dalam layar HP */
    .page-container {
        position: relative; 
        width: 100%;
        height: 100vh; 
        background: #F8FAFC; 
        overflow: hidden;
    }

    /* --- LAYOUT UTAMA --- */
    .header-layer { position: absolute; top: 0; left: 0; right: 0; z-index: 10; }
    .floating-area { position: absolute; top: 220px; left: 0; right: 0; z-index: 20; padding: 0 24px; }
    
    /* --- 2. PERBAIKAN: CONTENT SCROLL --- */
    .content-scroll {
        /* KUNCI AGAR BISA SCROLL: */
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0; /* Memenuhi layar */
        overflow-y: auto; /* Aktifkan scroll vertikal */
        
        /* Padding Anda (Tetap dipertahankan) */
        padding-top: 240px; 
        padding-left: 24px; 
        padding-right: 24px; 
        
        z-index: 5; /* Pastikan di bawah header & filter */
        
        /* Hilangkan scrollbar (Opsional) */
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-scroll::-webkit-scrollbar { display: none; }

    /* --- SISA KODE LAINNYA (TETAP SAMA) --- */
    .location-box { 
        background: white; 
        border-radius: 20px; 
        box-shadow: 0 10px 20px rgba(53, 119, 229, 0.15); 
        position: relative; 
        z-index: 50; 
    }
    /* ... kode css lainnya ... */
    
    .loc-header { 
        padding: 18px 20px; display: flex; align-items: center; cursor: pointer; 
    }

    .loc-list { 
        display: none; position: absolute; top: 100%; left: 0; right: 0; 
        background: white; border-radius: 0 0 20px 20px; 
        box-shadow: 0 15px 30px rgba(0,0,0,0.1); border-top: 1px solid #f0f0f0; 
        z-index: 100; overflow: hidden;
    }

    .loc-item { 
        padding: 16px 20px; font-weight: 600; font-size: 15px; color: #2A2A2A; 
        cursor: pointer; transition: background 0.2s; 
    }
    .loc-item:hover { background: #f8f9fa; }

    .location-box.active .loc-list { display: block; }
    .location-box.active { border-bottom-left-radius: 0; border-bottom-right-radius: 0; }

    /* --- BUTTON KATEGORI --- */
    .cat-btn { 
        background: white; color: #3577E5; padding: 12px 18px; width: 100px; 
        text-align: center; border-radius: 12px; font-weight: 700; font-size: 14px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.05); cursor: pointer; transition: all 0.2s; 
        border: 1px solid transparent; 
    }
    .cat-btn:active { transform: scale(0.95); }
    .cat-btn.active { background: #3577E5; color: white; box-shadow: 0 6px 15px rgba(53, 119, 229, 0.3); }

    /* --- SORT BOX --- */
    .sort-box { 
        background: white; border-radius: 15px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.05); position: relative; 
        min-width: 140px; z-index: 40; 
    }
    
    .sort-header { padding: 12px 18px; display: flex; align-items: center; cursor: pointer; justify-content: space-between; min-width: 150px;}
    .sort-list { display: none; position: absolute; top: 105%; right: 0; width: 100%; background: white; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); overflow: hidden; }
    .sort-item { padding: 12px 14px; font-size: 13px; cursor: pointer; border-bottom: 1px solid #f9f9f9; color: #333; font-weight: 500; }
    .sort-item:last-child { border-bottom: none; }
    .sort-item:hover { background: #f0f7ff; color: #3577E5; }
    .sort-box.active .sort-list { display: block; }

    /* --- CARD STYLE --- */
    .school-card {
        display: flex; position: relative; background: white; border-radius: 16px;
        padding: 12px; margin-bottom: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        align-items: flex-start; border: 1px solid #f8f9fa; cursor: pointer; transition: transform 0.1s;
    }
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
</style>
@endpush