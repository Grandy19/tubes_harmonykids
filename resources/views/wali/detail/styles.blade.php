@push('styles')
<style>
    /* --- STRUKTUR UTAMA --- */
    .detail-container {
        position: relative;
        width: 100%;
        height: 100vh; /* Tinggi fix 100% layar HP */
        background: #F8FAFC;
        overflow: hidden; /* Matikan scroll utama */
    }

    /* --- LAYER 1: HERO IMAGE --- */
    .hero-layer {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 380px;
        z-index: 0;
    }
    .hero-img { width: 100%; height: 100%; object-fit: cover; }
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.6) 100%);
    }

    /* --- LAYER 2: NAVIGASI & INFO --- */
    .header-layer {
        position: absolute;
        top: 0; left: 0; right: 0;
        z-index: 10;
        padding: 40px 24px 0;
        height: 380px;
        pointer-events: none;
    }

    /* Tombol Back & Love */
    .header-nav {
        display: flex; justify-content: space-between;
        pointer-events: auto;
        margin-bottom: auto;
    }
    .nav-btn {
        width: 44px; height: 44px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(4px);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #3577E5; border: none; text-decoration: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15); font-size: 18px; cursor: pointer;
    }

    /* Info Instansi */
    .hero-info {
        position: absolute; bottom: 80px; left: 24px; right: 24px;
        text-align: center; color: white;
    }
    .instansi-title { 
        font-size: 24px; font-weight: 800; margin-bottom: 6px; 
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }
    .instansi-loc { font-size: 13px; font-weight: 500; opacity: 0.95; }
    .rating-badge {
        display: inline-flex; align-items: center; gap: 5px;
        background: white; color: #1E293B;
        padding: 5px 14px; border-radius: 20px;
        font-weight: 700; font-size: 12px; margin-top: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    /* --- LAYER 3: KONTEN PUTIH (Scrollable) --- */
    .content-layer {
        position: absolute;
        top: 320px;
        bottom: 0; 
        left: 0; right: 0;
        z-index: 20;
        
        background: white;
        border-radius: 30px 30px 0 0;
        
        /* SCROLLING */
        overflow-y: auto; 
        
        /* PADDING */
        padding: 30px 24px 12px; /* Bawah 120px biar ga ketutup navbar */
        
        box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
        
        /* Hilangkan Scrollbar */
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* --- COMPONENTS --- */
    /* Tabs */
    .tabs-box {
        display: flex; background: white; padding: 6px; 
        border-radius: 16px; margin-bottom: 24px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    .tab-btn {
        flex: 1; padding: 10px 0; border: none; background: transparent;
        font-size: 13px; font-weight: 600; color: #64748B;
        border-radius: 12px; transition: all 0.2s; cursor: pointer;
    }
    .tab-btn.active {
        background: #3577E5; color: white; font-weight: 700;
        box-shadow: 0 4px 12px rgba(53, 119, 229, 0.3);
    }

    /* Content Styling */
    .tab-panel { display: none; animation: slideUp 0.3s; }
    .tab-panel.active { display: block; }
    @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .section-label { font-size: 15px; font-weight: 800; color: #1E293B; margin: 24px 0 12px; }
    .desc-text { font-size: 13px; color: #475569; line-height: 1.6; text-align: justify; }

    .photo-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px; }
    .photo-grid img { width: 100%; height: 110px; object-fit: cover; border-radius: 12px; background: #eee; }

    .prog-card {
        background: white; padding: 12px; border-radius: 12px;
        display: flex; align-items: center; gap: 10px; margin-bottom: 8px;
        border: 1px solid #E2E8F0;
    }
    .prog-card i { color: #3577E5; }
    .prog-card span { font-size: 13px; font-weight: 600; color: #334155; }

    .fas-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .fas-item { position: relative; height: 100px; border-radius: 14px; overflow: hidden; }
    .fas-item img { width: 100%; height: 100%; object-fit: cover; }

    /* --- UPDATE STYLE KARTU BIAYA & JAM --- */
    .stat-row { 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 16px; /* Jarak antar kartu */
        margin-bottom: 24px; 
    }
    .stat-card {
        background: white; 
        padding: 20px; 
        border-radius: 20px; /* Lebih bulat */
        text-align: center; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.06); /* Shadow halus */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 140px;
    }
    .stat-icon { 
        width: 65px; /* Icon lebih besar */
        height: 65px; 
        margin-bottom: 12px; 
        object-fit: contain; 
    }
    .stat-label { 
        font-size: 14px; 
        font-weight: 800; /* Bold Biru Tua */
        color: #0F3974; 
        margin-bottom: 4px;
        line-height: 1.2;
    }
    .stat-val { 
        font-size: 13px; 
        font-weight: 700; 
        color: #3577E5; /* Biru Terang */
    }

    /* --- CONTACT --- */
    .contact-row {
        background: white; padding: 14px; border-radius: 14px;
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 10px; border: 1px solid #E2E8F0;
    }
    .c-icon {
        width: 36px; height: 36px; background: #EFF6FF; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; color: #3577E5; margin-right: 12px;
    }
    .c-info div:first-child { font-size: 11px; font-weight: 700; color: #1E293B; }
    .c-info div:last-child { font-size: 11px; color: #64748B; }

    /* --- TOMBOL DAFTAR --- */
    .btn-daftar {
        display: block;
        width: 100%;
        height: 55px;
        background: #3577E5;
        color: white;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 800;
        text-align: center;
        line-height: 55px;
        text-decoration: none;
        margin-top: 30px;
        box-shadow: 0 8px 20px rgba(53, 119, 229, 0.3);
        transition: transform 0.2s;
    }
    .btn-daftar:active {
        transform: scale(0.98);
        box-shadow: 0 4px 10px rgba(53, 119, 229, 0.2);
    }
</style>
@endpush