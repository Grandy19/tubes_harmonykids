@push('styles')
<style>
    /* --- 1. CONTAINER UTAMA --- */
    .page-container {
        position: relative; 
        width: 100%;
        height: 100vh; 
        background: #F8FAFC; 
        overflow: hidden;
    }

    .header-layer { 
        position: absolute; top: 0; left: 0; right: 0; z-index: 10; 
    }
    
    /* FIX: Floating Area agar fleksibel */
    .floating-area { 
        position: absolute; 
        top: 220px; 
        left: 0; right: 0; 
        z-index: 20; 
        padding: 0 24px;
        display: flex;
        flex-direction: column;
        gap: 16px; /* Jarak antar elemen filter */
    }
    
    .content-scroll {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0; 
        overflow-y: auto; 
        
        /* Padding atas disesuaikan agar tidak ketutup filter */
        padding-top: 240px; 
        padding-left: 24px; 
        padding-right: 24px; 
        padding-bottom: 32px;
        
        z-index: 5; 
        
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-scroll::-webkit-scrollbar { display: none; }

    /* --- LOCATION DROPDOWN --- */
    .location-box { 
        background: white; 
        border-radius: 16px; 
        box-shadow: 0 8px 20px rgba(53, 119, 229, 0.1); 
        position: relative; 
        z-index: 50; 
        width: 100%;
    }
    .loc-header { 
        padding: 16px 20px; display: flex; align-items: center; cursor: pointer; 
        justify-content: space-between;
    }
    .loc-list { 
        display: none; position: absolute; top: 100%; left: 0; right: 0; 
        background: white; border-radius: 0 0 16px 16px; 
        box-shadow: 0 15px 30px rgba(0,0,0,0.1); border-top: 1px solid #f0f0f0; 
        z-index: 100; overflow: hidden;
    }
    .loc-item { 
        padding: 14px 20px; font-weight: 600; font-size: 14px; color: #2A2A2A; 
        cursor: pointer; transition: background 0.2s; 
    }
    .loc-item:hover { background: #f8f9fa; }
    .location-box.active .loc-list { display: block; }
    .location-box.active { border-bottom-left-radius: 0; border-bottom-right-radius: 0; }

    /* --- FILTER BAR (Kategori & Sortir) --- */
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        width: 100%;
    }

    /* BUTTON KATEGORI */
    .cat-wrapper {
        display: flex; gap: 8px; overflow-x: auto;
        -ms-overflow-style: none; scrollbar-width: none;
        flex: 1; /* Ambil sisa ruang */
    }
    .cat-wrapper::-webkit-scrollbar { display: none; }

    .cat-btn { 
        background: white; color: #64748B; padding: 10px 16px; 
        white-space: nowrap; /* Mencegah teks turun */
        border-radius: 12px; font-weight: 700; font-size: 13px; 
        box-shadow: 0 2px 8px rgba(0,0,0,0.05); cursor: pointer; transition: all 0.2s; 
        border: 1px solid transparent; 
        flex-shrink: 0;
    }
    .cat-btn:active { transform: scale(0.95); }
    .cat-btn.active { background: #3577E5; color: white; box-shadow: 0 6px 15px rgba(53, 119, 229, 0.25); }

    /* SORT BOX (FIX LEBAR) */
    .sort-box { 
        background: white; border-radius: 12px; 
        box-shadow: 0 2px 8px rgba(0,0,0,0.05); position: relative; 
        z-index: 40; flex-shrink: 0; /* Jangan mengecil */
    }
    
    .sort-header { 
        padding: 10px 14px; display: flex; align-items: center; cursor: pointer; 
        gap: 8px; font-size: 13px; font-weight: 600; color: #334155;
    }
    
    .sort-list { 
        display: none; position: absolute; top: 110%; right: 0; 
        width: 140px; /* Lebar dropdown fix */
        background: white; border-radius: 12px; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.1); overflow: hidden; 
    }
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
    .sc-img { width: 90px; height: 90px; border-radius: 12px; object-fit: cover; flex-shrink: 0; background: #eee; }
    .sc-content { flex: 1; padding-left: 14px; display: flex; flex-direction: column; justify-content: space-between; min-height: 90px; }
    .sc-title { font-weight: 800; font-size: 15px; color: #3577E5; margin-bottom: 2px; line-height: 1.2; padding-right: 40px; }
    .sc-price { font-weight: 700; font-size: 13px; color: #3577E5; margin-bottom: 6px; }
    .sc-badge { display: inline-flex; align-items: center; background-color: #4CD964; color: white; font-size: 10px; font-weight: 700; padding: 3px 8px; border-radius: 6px; width: fit-content; margin-bottom: 6px; }
    .sc-badge i { margin-right: 4px; font-size: 10px; }
    .sc-location { font-size: 12px; color: #666; font-weight: 600; display: flex; align-items: center; }
    .sc-location i { color: #3577E5; margin-right: 6px; font-size: 14px; }
    .sc-rating { position: absolute; top: 12px; right: 12px; background: white; border: 1px solid #f0f0f0; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-radius: 20px; padding: 4px 8px; display: flex; align-items: center; font-weight: 800; font-size: 11px; color: #333; }
    .sc-rating i { color: #FFC107; margin-right: 4px; font-size: 10px; }
</style>
@endpush