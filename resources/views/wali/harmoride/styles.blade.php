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
    
    .content-scroll {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0; 
        overflow-y: auto; 
        
        padding-top: 240px; 
        padding-left: 20px; 
        padding-right: 20px; 
        padding-bottom: 120px;
        
        z-index: 5; 
        
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-scroll::-webkit-scrollbar { display: none; }

    /* --- LOCATION DROPDOWN --- */
    .ride-location-box { 
        background: white; 
        border-radius: 16px; 
        box-shadow: 0 8px 20px rgba(53, 119, 229, 0.12); 
        position: relative; 
        z-index: 50; 
        width: 100%;
        margin-bottom: 20px;
    }
    .ride-loc-header { 
        padding: 16px 20px; 
        display: flex; 
        align-items: center; 
        cursor: pointer; 
        justify-content: space-between;
    }
    .ride-loc-list { 
        display: none; 
        position: absolute; 
        top: 100%; 
        left: 0; 
        right: 0; 
        background: white; 
        border-radius: 0 0 16px 16px; 
        box-shadow: 0 15px 30px rgba(0,0,0,0.1); 
        border-top: 1px solid #f0f0f0; 
        z-index: 100; 
        overflow: hidden;
    }
    .ride-loc-item { 
        padding: 14px 20px; 
        font-weight: 600; 
        font-size: 14px; 
        color: #2A2A2A; 
        cursor: pointer; 
        transition: background 0.2s; 
    }
    .ride-loc-item:hover { background: #f8f9fa; }
    .ride-location-box.open .ride-loc-list { display: block; }
    .ride-location-box.open { border-bottom-left-radius: 0; border-bottom-right-radius: 0; }

    /* --- DRIVER CARD --- */
    .driver-card {
        display: flex;
        position: relative;
        background: #ffffff;
        border-radius: 15px;
        padding: 12px;
        margin-bottom: 14px;
        box-shadow: 0 4px 16px rgba(53, 119, 229, 0.08);
        align-items: center;        /* foto & teks sejajar tengah */
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.15s;
        text-decoration: none;
    }
    .driver-card:active { transform: scale(0.98); box-shadow: 0 2px 8px rgba(53,119,229,0.08); }

    /* Foto driver */
    .driver-photo {
        width: 107px;
        height: 107px;              /* tinggi fix 107px */
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
        background: #dde9f9;
    }

    /* Info section */
    .driver-info {
        flex: 1;
        padding-left: 14px;
        padding-right: 52px;        /* ruang untuk rating badge */
        display: flex;
        flex-direction: column;
        justify-content: center;    /* konten teks rata tengah vertikal */
    }

    /* Nama driver */
    .driver-name {
        font-weight: 800;
        font-size: 15px;
        color: #3577E5;
        margin-bottom: 4px;
        line-height: 1.2;
    }

    /* Label judul bagian (Area Layanan, Tipe Kendaraan) */
    .driver-section-label {
        font-weight: 800;
        font-size: 12px;
        color: #3577E5;
        margin-bottom: 2px;
        margin-top: 1px;
    }

    /* Baris icon + teks */
    .driver-detail-val {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #616161;
        font-weight: 600;
        margin-bottom: 3px;
        gap: 7px;
    }
    .driver-detail-val i {
        font-size: 12px;
        color: #3577E5;
        width: 16px;
        text-align: center;
        flex-shrink: 0;
    }

    /* Rating badge */
    .driver-rating {
        position: absolute;
        top: 14px;
        right: 14px;
        background: white;
        box-shadow: 0 2px 8px rgba(53,119,229,0.10);
        border-radius: 20px;
        padding: 5px 10px;
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 800;
        font-size: 12px;
        color: #1a1a1a;
    }
    .driver-rating i {
        color: #FFC107;
        font-size: 14px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #94a3b8;
    }
    .empty-state i {
        font-size: 50px;
        margin-bottom: 16px;
        color: #cbd5e1;
    }
    .empty-state p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
    }

    /* Filter area */
    .filter-area {
        position: absolute; 
        top: 220px; 
        left: 0; right: 0; 
        z-index: 20; 
        padding: 0 20px;
    }
    /* --- MODAL DRIVER DETAIL --- */
    .driver-modal {
        position: absolute; /* Posisikan absolut di dalam .page-container */
        top: 0; left: 0; right: 0; bottom: 0;
        background: #F8FAFC;
        z-index: 90; /* LEBIH KECIL dari Navbar (100) agar Navbar tidak tertutup */
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    /* Modal Top: Background Photo */
    .modal-top {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 380px;
        z-index: 0;
    }
    .modal-bg-img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .modal-overlay {
        position: absolute; inset: 0;
        background: rgba(15, 23, 42, 0.45); /* Gelap merata agak tebal */
        backdrop-filter: blur(1px); /* Sedikit blur agar foto tidak terlalu tajam merusak teks */
        z-index: 1;
    }

    /* Modal Headers (Back, Heart) */
    .modal-header-icons {
        position: absolute;
        top: 40px; left: 24px; right: 24px;
        display: flex; justify-content: space-between;
        z-index: 10;
        pointer-events: auto;
    }
    .modal-back-btn, .modal-heart-btn {
        width: 44px; height: 44px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(4px);
        border-radius: 50%;
        border: none; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        cursor: pointer; font-size: 18px; color: #3577E5;
    }
    .modal-heart-btn { color: #3577E5; }

    /* Modal Info Overlay */
    .modal-info-overlay {
        position: absolute;
        bottom: 80px; left: 24px; right: 24px;
        text-align: center; color: white;
        z-index: 10;
    }
    .modal-info-overlay h2 {
        font-size: 24px; font-weight: 800; margin-bottom: 6px; text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
    }
    .modal-info-overlay p {
        font-size: 13px; font-weight: 600; margin-bottom: 14px; opacity: 1; text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
    }
    .modal-rating-badge {
        display: inline-flex; align-items: center;
        background: white; color: #1a1a1a;
        padding: 6px 16px; border-radius: 20px;
        font-weight: 800; font-size: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .modal-rating-badge i { color: #FFC107; margin-right: 6px; font-size: 15px;}

    /* Modal Bottom */
    .modal-bottom {
        position: absolute;
        top: 320px;
        bottom: 0;
        left: 0; right: 0;
        z-index: 20;
        background: #F8FAFC;
        border-radius: 30px 30px 0 0;
        padding: 24px 20px 100px 20px;
        overflow-y: auto;
        -ms-overflow-style: none; scrollbar-width: none;
        box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
    }
    .modal-bottom::-webkit-scrollbar { display: none; }

    /* Tabs */
    .modal-tabs {
        display: flex; gap: 12px; margin-bottom: 24px; justify-content: center;
    }
    .modal-tab {
        flex: 1; max-width: 160px;
        padding: 12px 0; border-radius: 12px;
        font-weight: 800; font-size: 14px; cursor: pointer;
        transition: all 0.2s; border: none; text-align: center;
    }
    .modal-tab:not(.active) {
        background: white; color: #3577E5;
        border: 1.5px solid #DBEAFE;
    }
    .modal-tab.active {
        background: #3B82F6; color: white;
        box-shadow: 0 6px 16px rgba(53, 119, 229, 0.3);
    }

    /* Tab Content */
    .tab-content { display: none; }
    .tab-content.active { display: block; animation: fadeIn 0.3s; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* Profil Card */
    .profil-card-blue {
        background: #3B82F6; border-radius: 20px;
        padding: 16px; display: flex; gap: 14px;
        color: white; margin-bottom: 24px;
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
        align-items: stretch;
    }
    .profil-thumb {
        width: 85px; border-radius: 14px;
        object-fit: cover; flex-shrink: 0;
        align-self: stretch; min-height: 85px;
    }
    .profil-details { flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
    .profil-details h3 { font-size: 16px; font-weight: 800; margin-bottom: 6px; line-height: 1.2; }
    .profil-id { font-size: 11px; margin-bottom: 6px; opacity: 0.95; }
    .profil-loc { font-size: 11px; font-weight: 600; }
    .profil-loc i { margin-right: 4px; font-size: 12px; }
    .profil-kartu-label { font-size: 10px; font-weight: 700; text-align: right; line-height: 1.2; opacity: 0.9; }
    .profil-online {
        background: #4ADE80; color: white;
        font-size: 11px; font-weight: 800;
        padding: 4px 10px; border-radius: 8px;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(34,197,94,0.4);
    }
    
    /* WA Button */
    .btn-wa {
        width: 100%; background: white; color: #0F3974;
        font-weight: 800; font-size: 15px;
        padding: 16px; border-radius: 16px; border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        cursor: pointer; transition: transform 0.2s;
    }
    .btn-wa:active { transform: scale(0.98); }

    /* Kendaraan Tab */
    .car-photo {
        width: 100%; height: 200px; object-fit: cover;
        border-radius: 16px; margin-bottom: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    .kendaraan-card {
        background: white; border-radius: 16px; padding: 20px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    }
    .k-title { color: #3577E5; font-size: 16px; font-weight: 800; margin: 0; }
    .kendaraan-kartu-label { color: #3577E5; font-size: 11px; font-weight: 700; line-height: 1.2; }
    .k-row {
        display: flex; justify-content: space-between;
        margin-bottom: 14px; font-size: 13px; align-items: center;
    }
    .k-row:last-child { margin-bottom: 0; }
    .k-label { color: #64748B; font-weight: 600; }
    .k-val { color: #3577E5; font-weight: 800; }
</style>
@endpush
