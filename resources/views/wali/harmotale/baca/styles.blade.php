@push('styles')
<style>
    /* ========================================
       HARMOTALE BACA - WEBTOON STYLE
    ======================================== */

    /* PAGE WRAPPER */
    .webtoon-page {
        width: 100%;
        background: #D9F3F5;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        padding-bottom: 30px;
    }

    /* ---- TOP HEADER KARTU JUDUL ---- */
    .webtoon-header {
        background: #C9EEF2;
        padding: 16px 20px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        border-bottom: 3px solid #A8DCDD;
    }

    /* Tombol Back */
    .webtoon-back-btn {
        position: absolute;
        top: 14px;
        left: 14px;
        background: white;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        cursor: pointer;
        text-decoration: none;
        color: #0F3974;
        font-size: 16px;
    }

    .webtoon-kelas {
        font-size: 12px;
        font-weight: 600;
        color: #5AACB0;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .webtoon-judul-besar {
        font-family: 'Baloo 2', cursive;
        font-size: 22px;
        font-weight: 800;
        color: #0F3974;
        text-align: center;
        line-height: 1.2;
        margin-bottom: 4px;
    }

    .webtoon-subtitle {
        font-size: 12px;
        color: #5AACB0;
        font-weight: 600;
        margin-bottom: 12px;
    }

    /* Gambar castle di header */
    .webtoon-header-img {
        width: 140px;
        height: 130px;
        object-fit: contain;
        position: absolute;
        right: 6px;
        top: 6px;
    }
    .webtoon-header-dragon {
        width: 60px;
        height: 60px;
        object-fit: contain;
        position: absolute;
        right: 0px;
        top: 2px;
    }

    /* ---- PANEL WEBTOON ---- */
    .webtoon-strip {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    /* Panel A: Gambar KIRI, teks KANAN */
    .panel {
        width: 100%;
        min-height: 200px;
        display: flex;
        align-items: stretch;
        position: relative;
        overflow: hidden;
    }

    .panel-a {
        background: #C2E9F0;
    }
    .panel-b {
        background: #D6EEF4;
        flex-direction: row-reverse;
    }
    .panel-c {
        background: #B8E4EC;
    }
    .panel-d {
        background: #CDE8F2;
        flex-direction: row-reverse;
    }
    .panel-e {
        background: #C8EDF3;
    }
    .panel-f {
        background: #DAEEF5;
        flex-direction: row-reverse;
    }

    /* Gambar dalam panel (50% lebar) */
    .panel-img-wrap {
        width: 50%;
        min-height: 200px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        overflow: hidden;
        padding: 0;
    }

    .panel-img-wrap img {
        width: 100%;
        height: 210px;
        object-fit: contain;
        object-position: bottom;
        display: block;
    }

    /* Teks dalam panel (50% lebar) */
    .panel-text-wrap {
        width: 50%;
        padding: 20px 14px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .panel-text-wrap p {
        font-size: 13px;
        font-weight: 600;
        color: #0F3974;
        line-height: 1.6;
        margin: 0;
    }

    /* Panel full-width: teks tengah + gambar kecil */
    .panel-full {
        width: 100%;
        background: #C2EEF5;
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 14px;
    }

    .panel-full h3 {
        font-family: 'Baloo 2', cursive;
        font-size: 20px;
        font-weight: 800;
        color: #0F3974;
        margin: 0;
        line-height: 1.3;
    }

    .panel-full p {
        font-size: 13px;
        font-weight: 600;
        color: #1A4A7A;
        line-height: 1.7;
        margin: 0;
    }

    .panel-full img {
        width: 140px;
        object-fit: contain;
    }

    /* Pemisah antar panel */
    .panel-divider {
        width: 100%;
        height: 3px;
        background: linear-gradient(to right, #A8DCDD, #74C5CE, #A8DCDD);
    }

    /* Teks miring untuk judul besar panel */
    .cursive-title {
        font-family: 'Dancing Script', 'Segoe Script', cursive;
        font-size: 24px;
        font-weight: 700;
        color: #0F3974;
        line-height: 1.2;
        margin-bottom: 8px;
    }

    /* Badge "Once Upon a Time" */
    .once-badge {
        background: rgba(255,255,255,0.5);
        border-radius: 12px;
        padding: 12px 16px;
        text-align: center;
    }

    /* END CARD */
    .end-card {
        margin: 20px 16px;
        background: white;
        border-radius: 20px;
        padding: 24px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(53, 119, 229, 0.15);
    }

    .end-card h4 {
        font-size: 18px;
        font-weight: 800;
        color: #0F3974;
        margin-bottom: 6px;
    }

    .end-card p {
        font-size: 13px;
        color: #666;
        margin-bottom: 16px;
    }

    .btn-selesai {
        display: inline-block;
        background: #3577E5;
        color: white;
        font-size: 14px;
        font-weight: 700;
        padding: 12px 28px;
        border-radius: 16px;
        border: none;
        text-decoration: none;
        box-shadow: 0 4px 0 #1A4A9E;
        transition: transform 0.1s;
    }
    .btn-selesai:hover { color: white; background: #2b65cf; }
    .btn-selesai:active { transform: translateY(2px); box-shadow: 0 2px 0 #1A4A9E; }

</style>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
@endpush
