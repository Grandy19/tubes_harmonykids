@push('styles')
<style>
    /* =========================================
       1. STRUKTUR UTAMA (FRAME HP)
       ========================================= */
    .page-container {
        position: relative; 
        width: 100%;
        height: 100vh; 
        background: #F8FAFC; 
        overflow: hidden; /* Kunci Scroll Body */
    }

    /* HEADER (FIXED) */
    .header-layer {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 130px; /* Area aman header */
        z-index: 50; 
        pointer-events: none;
    }
    .header-layer > * { pointer-events: auto; }

    /* CONTENT SCROLL (SCROLLABLE) */
    .content-scroll {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        padding-top: 240px; /* Jarak dari atas */
        /* padding-bottom: 120px;  */
        overflow-y: auto; 
        z-index: 5;
        background: #F8FAFC;
        
        /* Sembunyikan Scrollbar */
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-scroll::-webkit-scrollbar { display: none; }


    /* =========================================
       2. TABS & SORTIR (MODERN STYLE)
       ========================================= */
    .floating-area {
        position: relative; 
        padding: 0 24px; 
        margin-bottom: 24px;
        z-index: 20;
    }

    .tabs-row { display: flex; gap: 12px; align-items: center; }

    /* GAYA TAB */
    .tab-pill {
        background: white; 
        color: #64748B; /* Warna teks default (abu) */
        padding: 12px 25px; 
        border-radius: 12px; 
        font-weight: 700; font-size: 13px; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.03); 
        border: 1px solid transparent;
        text-decoration: none;
        display: inline-flex; align-items: center; justify-content: center;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Efek Tekan */
    .tab-pill:active { transform: scale(0.95); }

    /* State Aktif (Biru) */
    .tab-pill.active { 
        background: #3577E5; 
        color: white; 
        box-shadow: 0 8px 20px rgba(53, 119, 229, 0.25); /* Glow Biru */
    }

    /* --- TOMBOL SORTIR (KHUSUS) --- */
    .sort-dd { position: relative; margin-left: auto; /* Dorong ke kanan */ }

    .tab-pill.sort {
        background: white;
        color: #334155;
        padding: 12px 25px;
        min-width: 130px;
        justify-content: space-between; /* Teks kiri, Icon kanan */
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    /* --- DROPDOWN MENU --- */
    .sort-menu {
        display: none; 
        position: absolute; 
        top: 120%; right: 0; 
        width: 160px; 
        background: white; 
        border-radius: 12px; 
        box-shadow: 0 10px 40px rgba(0,0,0,0.1); 
        border: 1px solid #F1F5F9;
        overflow: hidden; 
        z-index: 100;
        padding: 6px;
    }
    .sort-menu.open { display: block; animation: popIn 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

    .sort-item {
        display: block; 
        padding: 10px 14px; 
        font-size: 13px; font-weight: 600; color: #64748B; 
        text-decoration: none; border-radius: 10px;
        transition: 0.1s;
    }
    .sort-item:hover { background: #F1F5F9; color: #3577E5; }
    .sort-item.active { background: #EFF6FF; color: #3577E5; font-weight: 800; }


    /* =========================================
       3. CTA BANNER (GRADIENT)
       ========================================= */
    .cta-banner-figma {
        background: linear-gradient(135deg, #3C7BEA 0%, #3577E5 100%);
        color: white; border-radius: 24px;
        padding: 24px; display: flex; align-items: center;
        justify-content: space-between; margin-top: 24px;
        box-shadow: 0 12px 30px rgba(53, 119, 229, 0.25);
        position: relative; overflow: hidden;
    }
    /* Hiasan Lingkaran Transparan */
    .cta-banner-figma::before {
        content: ''; position: absolute; top: -20px; right: -20px;
        width: 100px; height: 100px; background: rgba(255,255,255,0.1);
        border-radius: 50%; pointer-events: none;
    }

    .cta-white-btn-figma {
        background: white; color: #3577E5; padding: 10px 20px;
        border-radius: 12px; font-weight: 800; font-size: 12px; 
        text-decoration: none; display: inline-block; margin-top: 14px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.2s;
    }
    .cta-white-btn-figma:active { transform: scale(0.95); background: #F8FAFC; }


    /* =========================================
       4. POST CARD & INTERACTIONS
       ========================================= */
    .post {
        background: white; border-radius: 24px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02); /* Shadow sangat halus */
        padding: 20px; margin: 0 24px 24px 24px; 
        border: 1px solid #F1F5F9;
    }

    .post-head { display: flex; gap: 14px; align-items: center; margin-bottom: 14px; }
    .ava { 
        width: 44px; height: 44px; border-radius: 50%; 
        background-color: #EAF2FF; background-size: cover; background-position: center; 
        border: 2px solid #F8FAFC;
    }
    .name { font-weight: 800; color: #1E293B; font-size: 15px; letter-spacing: -0.3px; }
    .time { font-weight: 600; color: #94A3B8; font-size: 11px; margin-top: 2px; }
    
    .post-img-frame img { 
        width: 100%; border-radius: 20px; object-fit: cover; 
        margin-top: 10px; border: 1px solid #F1F5F9;
    }
    
    .content { 
        font-weight: 500; color: #334155; font-size: 14px; 
        margin: 14px 0; line-height: 1.6; 
    }
    
    /* Footer Actions */
    .foot {
        display: flex; gap: 24px; margin-top: 18px; color: #64748B;
        font-weight: 700; font-size: 13px; align-items: center;
        border-top: 1px solid #F8FAFC; padding-top: 14px;
    }
    .like-btn, .comment-btn { 
        all: unset; cursor: pointer; display: flex; align-items: center; gap: 8px; 
        transition: transform 0.1s; padding: 5px;
    }
    .like-btn:active, .comment-btn:active { transform: scale(1.2); color: #3577E5; }

    /* Comment Section */
    .comment-box { margin-top: 16px; background: #F8FAFC; border-radius: 16px; padding: 16px; display: none; }
    .comment-box.active { display: block; animation: slideDown 0.2s ease-out; }
    
    .comment-form { display: flex; gap: 10px; margin-top: 12px; }
    .comment-input {
        flex: 1; border: 1px solid #E2E8F0; border-radius: 12px; padding: 10px 14px; 
        font-weight: 600; font-size: 13px; outline: none; background: white;
    }
    .comment-input:focus { border-color: #3577E5; box-shadow: 0 0 0 3px rgba(53, 119, 229, 0.1); }
    .comment-send {
        border: none; background: #3577E5; color: #fff; font-weight: 900;
        border-radius: 12px; width: 40px; display: flex; align-items: center; justify-content: center;
        transition: 0.2s;
    }
    .comment-send:active { transform: scale(0.9); }

    .comment-item { font-size: 12px; color: #334155; margin: 10px 0; line-height: 1.5; padding-bottom: 10px; border-bottom: 1px dashed #E2E8F0; }
    .comment-item:last-child { border: none; padding-bottom: 0; }

    /* Animation Keyframes */
    @keyframes popIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush