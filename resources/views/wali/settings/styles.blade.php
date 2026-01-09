@push('styles')
<style>
    /* =========================================
       1. LAYOUT & SPACING
       ========================================= */
    .header-layer { 
        position: absolute; 
        top: 0; left: 0; right: 0; 
        height: 140px; 
        z-index: 50; 
        pointer-events: none; 
    }
    .header-layer > * { pointer-events: auto; }

    /* Area konten utama dengan padding yang pas */
    .setting-content-area {
        padding-top: 240px; 
        padding-left: 24px; 
        padding-right: 24px; 
        padding-bottom: 70px;
        overflow-y: auto;
        height: 100%;
        /* Hide Scrollbar */
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .setting-content-area::-webkit-scrollbar { display: none; }

    /* =========================================
       2. PROFILE CARD (MODERN STYLE)
       ========================================= */
    .profile-mini-card {
        background: white;
        border-radius: 24px; /* Sudut lebih bulat */
        padding: 20px;
        display: flex; align-items: center; gap: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04); /* Shadow halus & dalam */
        margin-bottom: 30px;
        border: 1px solid #F8FAFC;
        position: relative;
        overflow: hidden;
    }
    
    /* Hiasan background tipis */
    .profile-mini-card::after {
        content: ''; position: absolute; top: -20px; right: -20px;
        width: 80px; height: 80px; background: linear-gradient(135deg, #EFF6FF, #DBEAFE);
        border-radius: 50%; opacity: 0.5; z-index: 0;
    }

    .pm-img-wrapper { position: relative; z-index: 1; }
    
    .pm-img {
        width: 64px; height: 64px; 
        border-radius: 50%; object-fit: cover;
        background: #F1F5F9; 
        border: 3px solid #FFFFFF;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .pm-info { position: relative; z-index: 1; flex: 1; }
    .pm-info h4 { 
        font-size: 17px; font-weight: 800; 
        color: #1E293B; margin: 0; letter-spacing: -0.3px;
    }
    .pm-info p { 
        font-size: 13px; color: #64748B; 
        margin: 4px 0 0; font-weight: 500;
    }

    /* Icon Edit Kecil (Opsional, hiasan) */
    .pm-edit-icon {
        width: 32px; height: 32px; background: #F8FAFC;
        border-radius: 10px; display: flex; align-items: center; justify-content: center;
        color: #94A3B8; font-size: 14px; z-index: 1;
    }

    /* =========================================
       3. MENU GROUP & ITEMS
       ========================================= */
    .setting-group { margin-bottom: 24px; }
    
    .group-title {
        font-size: 12px; font-weight: 800; color: #94A3B8; 
        margin-bottom: 12px; padding-left: 8px; 
        text-transform: uppercase; letter-spacing: 0.8px;
    }
    
    .menu-list {
        background: white; 
        border-radius: 20px; 
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02); 
        border: 1px solid #F1F5F9;
    }

    .menu-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 18px 20px; 
        cursor: pointer; text-decoration: none;
        transition: all 0.2s ease;
        border-bottom: 1px solid #F8FAFC;
        position: relative;
    }
    .menu-item:last-child { border-bottom: none; }
    
    /* Hover & Active State */
    .menu-item:active { background: #F8FAFC; transform: scale(0.99); }
    .menu-item:hover .mi-arrow { transform: translateX(3px); color: #3577E5; }

    .mi-left { display: flex; align-items: center; gap: 14px; }
    
    .mi-icon {
        width: 38px; height: 38px; border-radius: 12px;
        background: #EFF6FF; color: #3577E5; /* Warna Brand */
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; transition: transform 0.2s;
    }
    /* Icon 'pop' saat ditekan */
    .menu-item:active .mi-icon { transform: scale(0.9); }

    .mi-text { 
        font-size: 14px; font-weight: 600; 
        color: #334155; letter-spacing: -0.2px; 
    }
    
    .mi-arrow { 
        font-size: 14px; color: #CBD5E1; 
        transition: all 0.2s; 
    }

    /* =========================================
       4. LOGOUT BUTTON
       ========================================= */
    .btn-logout {
        width: 100%; 
        background: white; 
        color: #EF4444;
        font-weight: 700; font-size: 14px;
        padding: 16px; 
        border-radius: 18px;
        border: 2px solid #FEF2F2; /* Border tipis merah muda */
        cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        margin-top: 10px; 
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.05);
        transition: all 0.2s;
    }
    
    .btn-logout:hover {
        border-color: #FEE2E2;
        background: #FEF2F2;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.1);
    }
    
    .btn-logout:active { 
        transform: scale(0.98); 
        background: #FEE2E2; 
    }

    /* =========================================
       5. SWEETALERT FIX (FRAME LOCK)
       ========================================= */
    /* Memaksa popup diam di dalam mobile-card */
    .mobile-card .swal2-container {
        position: absolute !important;
        top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;
        height: 100% !important; width: 100% !important;
        border-radius: 0 !important; /* Reset radius agar full */
        z-index: 9999 !important;
        background: rgba(0,0,0,0.5) !important; /* Backdrop gelap */
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    /* Styling Popupnya */
    .mobile-card .swal2-popup {
        font-family: 'Baloo 2', sans-serif !important;
        border-radius: 24px !important;
        padding: 24px !important;
        width: 85% !important; /* Agar tidak terlalu lebar di HP */
        max-width: 320px !important;
    }
    
    .mobile-card .swal2-title { font-size: 20px !important; color: #1E293B !important; }
    .mobile-card .swal2-html-container { font-size: 14px !important; color: #64748B !important; }
    
    .mobile-card .swal2-confirm {
        background-color: #3577E5 !important;
        border-radius: 12px !important;
        box-shadow: none !important;
    }
    .mobile-card .swal2-cancel {
        background-color: #F1F5F9 !important;
        color: #64748B !important;
        border-radius: 12px !important;
    }
</style>
@endpush