@push('styles')
<style>
    .header-container {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 300px; z-index: 10;
    }
    .header-bg {
        position: absolute; top: 0; left: 0; width: 100%; height: 245px;
        background: url("{{ asset('assets/images/texture.png') }}");
        background-size: cover; background-color: #3577E5;
        border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;
    }
    .cloud-img {
        position: absolute; top: 195px; left: 0; width: 100%; height: 70px;
        object-fit: fill; z-index: 2;
    }
    .profile-row {
        position: absolute; top: 40px; left: 24px; right: 24px;
        display: flex; justify-content: space-between; align-items: center; z-index: 3;
    }
    .avatar-circle {
        width: 45px; height: 45px; border-radius: 50%; border: 2px solid white;
        background-size: cover; background-color: #ddd; display: block;
    }
    .user-info { margin-left: 12px; color: white; display: flex; flex-direction: column; }
    .greeting { font-size: 14px; opacity: 0.9; line-height: 1; }
    .username { font-size: 20px; font-weight: 800; line-height: 1.2; }
    .logo-img { height: 60px; }
    .location-bar-wrapper {
        position: absolute; top: 115px; left: 24px; right: 24px; z-index: 20;
    }
    .location-bar {
        background: white; height: 55px; border-radius: 16px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        display: flex; align-items: center; padding: 0 20px;
        cursor: pointer; transition: all 0.3s;
    }
    .dropdown-menu-custom {
        background: white; border-radius: 16px; margin-top: 8px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        overflow: hidden; display: none; position: absolute; width: 100%;
    }
    .location-bar-wrapper.active .dropdown-menu-custom { display: block; }
    .dropdown-item-custom {
        padding: 12px 20px; font-weight: 600; font-size: 14px; color: #333;
        cursor: pointer; border-bottom: 1px solid #eee;
    }
    .dropdown-item-custom:hover { background-color: #f8f9fa; }
    
    /* BAGIAN INI YANG MENGATUR JARAK BAWAH */
    .content-scroll {
        padding: 280px 24px 150px 24px;
        min-height: 100%;
    }
    
    .promo-banner {
        width: 100%; height: 160px; border-radius: 20px;
        background: linear-gradient(90deg, #3577E5 0%, #5A9BF8 100%);
        box-shadow: 0 8px 15px rgba(53, 119, 229, 0.4);
        position: relative; overflow: hidden; margin-bottom: 30px;
    }
    .banner-text-area { padding: 24px; width: 60%; z-index: 2; position: relative; }
    .banner-quote { color: white; font-size: 18px; font-weight: 700; line-height: 1.4; margin-bottom: 15px; }
    .btn-banner {
        background: white; color: #0F3974; font-weight: 800; font-size: 14px;
        padding: 8px 20px; border-radius: 12px; text-decoration: none; display: inline-block;
        box-shadow: 0 4px 0 #D8D5EA; transition: transform 0.1s;
    }
    .btn-banner:active { transform: translateY(2px); box-shadow: 0 2px 0 #D8D5EA; }
    .banner-img-child { position: absolute; right: 10px; bottom: 0; height: 140px; z-index: 1; }
    .menu-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px 15px; margin-bottom: 30px; }
    .menu-item { display: flex; flex-direction: column; align-items: center; text-decoration: none; color: #0F3974; transition: transform 0.2s; }
    .menu-item:hover { transform: translateY(-5px); }
    .menu-icon-box {
        width: 65px; height: 65px; background: white; border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; margin-bottom: 8px;
    }
    .menu-icon-box img { width: 40px; height: 40px; object-fit: contain; }
    .menu-title { font-size: 13px; font-weight: 700; text-align: center; }
    .recom-card {
        display: flex; position: relative; background: white; border-radius: 16px;
        padding: 12px; margin-bottom: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        align-items: flex-start; border: 1px solid #f8f9fa;
    }
    .recom-img { width: 100px; height: 100px; border-radius: 12px; object-fit: cover; flex-shrink: 0; }
    .recom-content { flex: 1; padding-left: 14px; display: flex; flex-direction: column; justify-content: space-between; min-height: 100px; }
    .recom-title { font-weight: 800; font-size: 15px; color: #3577E5; margin-bottom: 2px; line-height: 1.2; padding-right: 40px; }
    .recom-price { font-weight: 700; font-size: 14px; color: #3577E5; margin-bottom: 8px; }
    .recom-badge { display: inline-flex; align-items: center; background-color: #4CD964; color: white; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px; width: fit-content; margin-bottom: 8px; }
    .recom-badge i { margin-right: 5px; font-size: 11px; }
    .recom-location { font-size: 12px; color: #666; font-weight: 600; display: flex; align-items: center; }
    .recom-location i { color: #3577E5; margin-right: 6px; font-size: 14px; }
    .recom-rating { position: absolute; top: 12px; right: 12px; background: white; border: 1px solid #f0f0f0; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-radius: 20px; padding: 4px 8px; display: flex; align-items: center; font-weight: 800; font-size: 12px; color: #333; }
    .recom-rating i { color: #FFC107; margin-right: 4px; font-size: 11px; }
    .btn-more { display: block; background: #3577E5; color: white; padding: 14px; border-radius: 14px; text-align: center; font-weight: 800; text-decoration: none; margin-top: 10px; }
</style>
@endpush