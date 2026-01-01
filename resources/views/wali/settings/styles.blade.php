@push('styles')
<style>
    /* --- HEADER (Fixed dalam Frame) --- */
    .header-layer { 
        position: absolute; 
        top: 0; left: 0; right: 0; 
        height: 140px; 
        z-index: 50; 
        pointer-events: none; 
    }
    .header-layer > * { pointer-events: auto; }

    /* --- CONTENT AREA --- */
    .setting-content-area {
        padding-top: 130px; 
        padding-left: 20px; 
        padding-right: 20px; 
    }

    /* --- STYLE KOMPONEN SETTING --- */
    .profile-mini-card {
        background: white; border-radius: 20px; padding: 20px;
        display: flex; align-items: center; gap: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 24px;
        border: 1px solid #f0f0f0;
    }
    .pm-img {
        width: 60px; height: 60px; border-radius: 50%; object-fit: cover;
        background: #eee; border: 2px solid #e3f2fd;
    }
    .pm-info h4 { font-size: 16px; font-weight: 800; color: #2A2A2A; margin: 0; }
    .pm-info p { font-size: 13px; color: #64748B; margin: 2px 0 0; }

    .setting-group { margin-bottom: 20px; }
    .group-title {
        font-size: 13px; font-weight: 700; color: #94A3B8; 
        margin-bottom: 10px; padding-left: 10px; text-transform: uppercase; letter-spacing: 0.5px;
    }
    
    .menu-list {
        background: white; border-radius: 16px; overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03); border: 1px solid #f8f9fa;
    }

    .menu-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 20px; cursor: pointer; text-decoration: none;
        transition: background 0.2s; border-bottom: 1px solid #f8f9fa;
    }
    .menu-item:last-child { border-bottom: none; }
    .menu-item:active { background: #f8f9fa; }

    .mi-left { display: flex; align-items: center; gap: 12px; }
    .mi-icon {
        width: 36px; height: 36px; border-radius: 10px;
        background: #F1F5F9; color: #3577E5;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
    }
    .mi-text { font-size: 14px; font-weight: 600; color: #333; }
    .mi-arrow { font-size: 12px; color: #cbd5e1; }

    .btn-logout {
        width: 100%; background: #FFF0F0; color: #EF4444;
        font-weight: 700; padding: 16px; border-radius: 16px;
        border: 1px solid #FECaca; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 10px;
        margin-top: 20px; transition: 0.2s;
    }
    .btn-logout:active { transform: scale(0.98); background: #fee2e2; }

    /* --- [PENTING] PERBAIKAN AGAR POPUP MASUK FRAME --- */
    /* CSS ini memaksa SweetAlert untuk diam di dalam .mobile-card */
    .mobile-card .swal2-container {
        position: absolute !important; /* Ganti fixed jadi absolute */
        top: 0 !important;
        left: 0 !important;
        height: 100% !important;
        width: 100% !important;
        border-radius: 20px; /* Agar sudutnya melengkung ikut frame */
        z-index: 9999 !important;
    }
</style>
@endpush