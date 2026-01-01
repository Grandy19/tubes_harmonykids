@push('styles')
<style>
    /* --- 1. STRUKTUR UTAMA --- */
    .page-container {
        position: relative; width: 100%; height: 100vh;
        background: #F8FAFC; overflow: hidden;
    }

    .header-layer {
        position: absolute; top: 0; left: 0; right: 0;
        height: 120px; z-index: 50; pointer-events: none;
    }
    .header-layer > * { pointer-events: auto; }

    .content-scroll {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        padding-top: 100px; /* Jarak dari header */
        padding-bottom: 120px; /* Jarak untuk Bottom Nav */
        overflow-y: auto; z-index: 10;
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-scroll::-webkit-scrollbar { display: none; }

    /* --- 2. STYLE CARD (Mirip HarmoTalent) --- */
    .school-card {
        display: flex; position: relative; background: white;
        border-radius: 16px; padding: 12px;
        margin: 0 24px 16px 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        align-items: flex-start; border: 1px solid #f8f9fa;
        text-decoration: none; color: inherit;
        transition: transform 0.1s;
    }
    .school-card:active { transform: scale(0.98); }

    .sc-img {
        width: 100px; height: 100px; border-radius: 12px;
        object-fit: cover; flex-shrink: 0; background: #eee;
    }

    .sc-content {
        flex: 1; padding-left: 14px;
        display: flex; flex-direction: column;
        justify-content: space-between; min-height: 100px;
    }

    .sc-title {
        font-weight: 800; font-size: 15px; color: #1E293B;
        margin-bottom: 4px; line-height: 1.3; padding-right: 30px;
    }

    .sc-price {
        font-weight: 700; font-size: 14px; color: #3577E5; margin-bottom: 8px;
    }

    /* Tombol Unlike (Hati Merah) */
    .btn-unlike {
        position: absolute; top: 12px; right: 12px;
        width: 32px; height: 32px;
        background: #FEE2E2; /* Merah Muda background */
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #EF4444; /* Merah Hati */
        font-size: 16px;
        cursor: pointer; z-index: 20;
        transition: 0.2s;
        border: none;
    }
    .btn-unlike:active { transform: scale(0.8); }

    .sc-location {
        font-size: 12px; color: #64748B; font-weight: 600;
        display: flex; align-items: center;
    }
    .sc-location i { color: #3577E5; margin-right: 6px; font-size: 14px; }
    
    .rating-chip {
        display: inline-flex; align-items: center;
        background: #FEF9C3; color: #854D0E;
        font-size: 10px; font-weight: 800;
        padding: 4px 8px; border-radius: 8px;
        margin-bottom: 6px; width: fit-content;
    }
</style>
@endpush