@push('styles')
<style>
    /* ==============================
       HEADER (FIXED DALAM FRAME)
       ============================== */
    .header-layer {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 130px;
        z-index: 50;
        pointer-events: none;
    }
    .header-layer > * {
        pointer-events: auto;
    }

    /* ==============================
       CONTENT AREA (SCROLL AREA)
       ============================== */
    .setting-content-area {
        padding-top: 240px; /* JARAK DARI HEADER */
        padding-left: 16px;
        padding-right: 16px;
    }

    /* ==============================
       NOTIFIKASI CARD
       ============================== */
    .notif-card {
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 6px 20px rgba(15, 57, 116, 0.08);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .notif-card:active {
        transform: scale(0.98);
        box-shadow: 0 4px 12px rgba(15, 57, 116, 0.12);
    }

    /* ==============================
       ICON STATUS
       ============================== */
    .notif-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .notif-pending {
        background: rgba(245, 158, 11, 0.15);
        color: #f59e0b;
    }

    .notif-verified {
        background: rgba(56, 189, 248, 0.15);
        color: #0ea5e9;
    }

    .notif-accepted {
        background: rgba(34, 197, 94, 0.15);
        color: #16a34a;
    }

    .notif-rejected {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
    }

    /* ==============================
       TEXT HIERARCHY
       ============================== */
    .notif-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 2px;
    }

    .notif-desc {
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
        margin-bottom: 4px;
    }

    .notif-time {
        font-size: 11px;
        color: #94a3b8;
    }

    /* ==============================
       EMPTY STATE
       ============================== */
    .notif-empty {
        padding: 60px 20px;
        text-align: center;
        color: #94a3b8;
    }

    .notif-empty i {
        font-size: 32px;
        margin-bottom: 12px;
        opacity: .8;
    }

    .notif-empty p {
        font-size: 14px;
        margin: 0;
    }
</style>
@endpush
