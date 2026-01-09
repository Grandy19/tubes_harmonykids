@push('styles')
<style>
    /* --- LAYOUT UTAMA (MIRIP DETAIL) --- */
    .page-container {
        position: relative;
        width: 100%;
        height: 100vh; /* Full Height HP */
        background: #F8FAFC;
        overflow: hidden; /* Matikan scroll body */
    }

    /* --- LAYER 1: HERO IMAGE --- */
    .hero-layer {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 300px; /* Sedikit lebih pendek dari detail biar form lebih naik */
        z-index: 0;
    }
    .hero-img { width: 100%; height: 100%; object-fit: cover; }
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
    }

    /* --- LAYER 2: HEADER & INFO --- */
    .header-layer {
        position: absolute;
        top: 0; left: 0; right: 0;
        z-index: 10;
        padding: 40px 24px 0;
        height: 300px;
        pointer-events: none; /* Biar tembus klik ke layer bawah jika kosong */
    }

    /* Tombol Back */
    .header-nav {
        display: flex; justify-content: space-between;
        pointer-events: auto; /* Aktifkan klik tombol */
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

    /* Info Instansi di Header */
    .hero-info {
        position: absolute; bottom: 60px; left: 24px; right: 24px;
        text-align: center; color: white;
    }
    .instansi-title { 
        font-size: 22px; font-weight: 800; margin-bottom: 6px; 
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }
    .instansi-loc { font-size: 12px; font-weight: 500; opacity: 0.95; }

    /* --- LAYER 3: FORM CONTENT (SCROLLABLE) --- */
    .content-layer {
        position: absolute;
        top: 260px; /* Mulai menumpuk gambar */
        bottom: 0; 
        left: 0; right: 0;
        z-index: 20;
        
        background: white;
        border-radius: 30px 30px 0 0;
        
        /* SCROLLING DI DALAM SINI */
        overflow-y: auto; 
        
        /* PADDING */
        padding: 30px 24px 120px; 
        
        box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
        
        /* Hilangkan Scrollbar */
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-layer::-webkit-scrollbar { display: none; }

    /* --- FORM COMPONENTS --- */
    .input-group-custom {
        background: white; border: 1px solid #E2E8F0; border-radius: 16px;
        padding: 0 16px; height: 55px; display: flex; align-items: center;
        margin-bottom: 16px; transition: 0.2s;
    }
    .input-group-custom:focus-within { border-color: #3577E5; box-shadow: 0 4px 15px rgba(53, 119, 229, 0.1); }
    .input-icon { width: 24px; text-align: center; color: #3577E5; margin-right: 12px; font-size: 16px; }
    .form-control-custom { flex: 1; border: none; outline: none; font-weight: 600; color: #334155; font-size: 13px; background: transparent; width: 100%; }
    .form-control-custom::placeholder { color: #94A3B8; font-weight: 500; }
    select.form-control-custom { appearance: none; -webkit-appearance: none; cursor: pointer; }
    .dropdown-arrow { color: #94A3B8; font-size: 12px; pointer-events: none; }

    /* PAYMENT CARD */
    .payment-label { font-size: 13px; font-weight: 700; color: #0F172A; margin: 24px 0 12px; }
    .payment-card {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        border-radius: 20px; padding: 20px; display: flex; align-items: center; gap: 16px;
        color: white; margin-bottom: 16px; box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
    }
    .payment-card.bca { background: linear-gradient(135deg, #005EB8 0%, #003B73 100%); }
    .payment-card.bni { background: linear-gradient(135deg, #F15A23 0%, #C63F0F 100%); }
    .payment-card.bri { background: linear-gradient(135deg, #00529C 0%, #00386B 100%); }

    .bank-logo-box { width: 50px; height: 50px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .bank-logo-box img { width: 35px; object-fit: contain; }
    .rek-info div:nth-child(1) { font-size: 12px; font-weight: 500; opacity: 0.9; text-transform: uppercase; }
    .rek-info div:nth-child(2) { font-size: 16px; font-weight: 800; margin: 2px 0 4px; letter-spacing: 1px; font-family: monospace; }
    .rek-info div:nth-child(3) { font-size: 14px; font-weight: 700; color: #FFD700; }

    /* UPLOAD */
    .upload-box {
        background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 16px;
        padding: 12px 16px; display: flex; align-items: center; justify-content: space-between;
        cursor: pointer; transition: 0.2s;
    }
    .upload-box:active { background: #EFF6FF; border-color: #3577E5; }
    .btn-pilih-file { background: #3577E5; color: white; font-size: 11px; font-weight: 700; padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer; }
    .file-name { font-size: 12px; color: #64748B; margin-left: 10px; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* SUBMIT BUTTON */
    .btn-submit {
        display: block; width: 100%; height: 55px; background: #3577E5; color: white;
        border-radius: 16px; font-size: 16px; font-weight: 800; margin-top: 32px;
        cursor: pointer; box-shadow: 0 10px 25px rgba(53, 119, 229, 0.25); border:none; transition: 0.2s;
    }
    .btn-submit:active { transform: scale(0.98); }

    /* POPUP OVERLAY (NEMPEL KE FRAME) */
.frame-popup-overlay{
    position: absolute;
    inset: 0;
    background: rgba(15,23,42,.55);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

/* CARD */
.frame-popup-card{
    width: 85%;
    max-width: 320px;
    background: white;
    border-radius: 22px;
    padding: 28px 22px;
    text-align: center;
    box-shadow: 0 25px 50px rgba(0,0,0,.25);
    animation: popupScale .25s ease;
}

/* ICON */
.popup-icon{
    width: 72px;
    height: 72px;
    margin: 0 auto 16px;
    border-radius: 50%;
    background: #DCFCE7;
    display: flex;
    align-items: center;
    justify-content: center;
}
.popup-icon i{
    font-size: 34px;
    color: #22C55E;
}

/* TEXT */
.frame-popup-card h3{
    font-size: 20px;
    font-weight: 800;
    color: #0F172A;
    margin-bottom: 6px;
}
.frame-popup-card p{
    font-size: 14px;
    color: #64748B;
    margin-bottom: 22px;
}

/* BUTTON */
.frame-popup-card button{
    width: 100%;
    height: 48px;
    border: none;
    border-radius: 14px;
    background: #3577E5;
    color: white;
    font-size: 16px;
    font-weight: 800;
    cursor: pointer;
}
.frame-popup-card button:active{
    transform: scale(.97);
}

/* ANIMASI */
@keyframes popupScale{
    from{transform: scale(.85);opacity:0}
    to{transform: scale(1);opacity:1}
}

</style>
@endpush