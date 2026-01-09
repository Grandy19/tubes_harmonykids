@push('styles')
<style>
.header-layer {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 140px;
    z-index: 50;
    pointer-events: none;
}
.header-layer > * {
    pointer-events: auto;
}

.setting-content-area {
    padding-top: 240px;     
    padding-left: 20px;
    padding-right: 20px;
    padding-bottom: 32px;  
    box-sizing: border-box;
}

.fav-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.fav-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
}

.fav-inner {
    display: flex;
    gap: 14px;
    align-items: center;
}

.fav-thumb img {
    width: 72px;
    height: 72px;
    border-radius: 14px;
    object-fit: cover;
    background: #f1f5f9;
}

.fav-content {
    flex: 1;
    text-decoration: none;
}

.fav-title {
    font-size: 15px;
    font-weight: 800;
    color: #3577E5;
}

.fav-meta {
    font-size: 13px;
    color: #3577E5;
    margin-top: 4px;
}

.fav-type {
    margin-top: 6px;
    font-size: 11px;
    font-weight: 700;
    color: #3577E5;
    background: #eaf2ff;
    padding: 4px 10px;
    border-radius: 999px;
    width: fit-content;
}

.fav-like-btn {
    width: 36px;
    height: 36px;
    border-radius: 12px;
    background: #fff0f0;
    border: 1px solid #fecaca;
    display: flex;
    align-items: center;
    justify-content: center;
}

.fav-like-btn i {
    color: #ef4444;
    font-size: 16px;
}

.fav-empty {
    text-align: center;
    color: #94a3b8;
    padding: 80px 0;
}
</style>
@endpush
